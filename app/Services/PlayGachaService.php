<?php

namespace App\Services;

use App\Models\DemeritMaster;
use App\Models\EffectMaster;
use App\Models\Relic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PlayGachaService
{
    private const ITEM_TYPE_RELIC = 0;
    private const ITEM_TYPE_VESSEL = 1;
    private const RELICS_PER_TICKET = 5;

    public function play(string $userUuid, int $useTicketCount, int $itemTypeFlag): array
    {
        if ($itemTypeFlag === self::ITEM_TYPE_VESSEL) {
            throw new RuntimeException('器ガチャは未実装です。');
        }

        if ($itemTypeFlag !== self::ITEM_TYPE_RELIC) {
            throw new RuntimeException('item_type_flag が不正です。');
        }

        return DB::transaction(function () use ($userUuid, $useTicketCount): array {
            $user = User::query()
                ->where('user_uuid', $userUuid)
                ->lockForUpdate()
                ->first();

            if ($user === null) {
                throw new RuntimeException('ユーザーが見つかりません。');
            }

            if ($user->ticket < $useTicketCount) {
                throw new RuntimeException('チケットが不足しています。');
            }

            $effects = EffectMaster::query()->get(['effect_id', 'effect_name', 'demerit_rate']);
            $demerits = DemeritMaster::query()->get(['demerit_id', 'demerit_name', 'is_status']);

            if ($effects->count() < 3 || $demerits->isEmpty()) {
                throw new RuntimeException('ガチャマスターデータが不足しています。');
            }

            $createdRelics = [];
            $effectNameMap = collect($effects)->pluck('effect_name', 'effect_id')->all();
            $demeritNameMap = collect($demerits)->pluck('demerit_name', 'demerit_id')->all();
            $totalRelicCount = $useTicketCount * self::RELICS_PER_TICKET;

            for ($i = 0; $i < $totalRelicCount; $i++) {
                $relicData = $this->buildRelicPayload((int) $user->user_id, $effects->all(), $demerits->all());
                $relic = Relic::query()->create($relicData);
                $createdRelics['relic' . ($i + 1)] = $this->formatRelicResponse($relic->toArray(), $effectNameMap, $demeritNameMap);
            }

            $user->ticket = $user->ticket - $useTicketCount;
            $user->save();

            return [
                'used_ticket_count' => $useTicketCount,
                'obtained_count' => $totalRelicCount,
                'relics' => $createdRelics,
            ];
        });
    }

    private function buildRelicPayload(int $userId, array $effects, array $demerits): array
    {
        $selectedEffects = collect($effects)->shuffle()->take(random_int(1, 3))->values();

        $selectedEffectNames = [];
        $usedDemeritIds = [];
        $slots = [];

        foreach ($selectedEffects as $index => $effect) {
            $slotNumber = $index + 1;
            $selectedEffectNames[] = $effect->effect_name;

            [$demeritId, $effectBuff, $demeritBuff] = $this->resolveDemerit(
                (int) $effect->demerit_rate,
                $demerits,
                $selectedEffectNames,
                $usedDemeritIds
            );

            $slots[$slotNumber] = [
                'effect_id' => (int) $effect->effect_id,
                'effect_buff' => $effectBuff,
                'demerit_id' => $demeritId,
                'demerit_buff' => $demeritBuff,
            ];
        }

        return [
            'user_id' => $userId,
            'color' => random_int(0, 3),
            'effect_id1' => $slots[1]['effect_id'] ?? null,
            'effect_buff1' => $slots[1]['effect_buff'] ?? null,
            'demerit_id1' => $slots[1]['demerit_id'] ?? null,
            'demerit_buff1' => $slots[1]['demerit_buff'] ?? null,
            'effect_id2' => $slots[2]['effect_id'] ?? null,
            'effect_buff2' => $slots[2]['effect_buff'] ?? null,
            'demerit_id2' => $slots[2]['demerit_id'] ?? null,
            'demerit_buff2' => $slots[2]['demerit_buff'] ?? null,
            'effect_id3' => $slots[3]['effect_id'] ?? null,
            'effect_buff3' => $slots[3]['effect_buff'] ?? null,
            'demerit_id3' => $slots[3]['demerit_id'] ?? null,
            'demerit_buff3' => $slots[3]['demerit_buff'] ?? null,
            'is_favorite' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function resolveDemerit(int $demeritRate, array $demerits, array $selectedEffectNames, array &$usedDemeritIds): array
    {
        $effectBuff = null;
        $demeritId = null;
        $demeritBuff = null;

        if ($demeritRate === 0) {
            return [$demeritId, $effectBuff, $demeritBuff];
        }

        if ($demeritRate === 3) {
            $effectBuff = random_int(1, 3);
            if ($effectBuff <= 2) {
                return [$demeritId, $effectBuff, $demeritBuff];
            }

            $shouldAttachDemerit = random_int(1, 100) <= 50;
        } elseif ($demeritRate === 1) {
            $shouldAttachDemerit = random_int(1, 100) <= 50;
        } else {
            $shouldAttachDemerit = true;
        }

        if (!$shouldAttachDemerit) {
            return [$demeritId, $effectBuff, $demeritBuff];
        }

        $candidateDemerits = collect($demerits)
            ->reject(function ($demerit) use ($usedDemeritIds, $selectedEffectNames) {
                return in_array((int) $demerit->demerit_id, $usedDemeritIds, true)
                    || in_array($demerit->demerit_name, $selectedEffectNames, true);
            })
            ->values();

        if ($candidateDemerits->isEmpty()) {
            return [$demeritId, $effectBuff, $demeritBuff];
        }

        $picked = $candidateDemerits->random();
        $demeritId = (int) $picked->demerit_id;
        $usedDemeritIds[] = $demeritId;

        if ((bool) $picked->is_status) {
            $demeritBuff = random_int(1, 3);
        }

        return [$demeritId, $effectBuff, $demeritBuff];
    }

    private function formatRelicResponse(array $relic, array $effectNameMap, array $demeritNameMap): array
    {
        $lines = [
            'color' => $relic['color'],
        ];

        for ($slot = 1; $slot <= 3; $slot++) {
            $effectId = $relic['effect_id' . $slot];
            $demeritId = $relic['demerit_id' . $slot];
            $lines['merit' . $slot] = null;
            $lines['demerit' . $slot] = null;

            if ($effectId !== null && isset($effectNameMap[$effectId])) {
                $effectBuff = (int) ($relic['effect_buff' . $slot] ?? 0);
                $lines['merit' . $slot] = $effectNameMap[$effectId] . ($effectBuff === 0 ? '' : '+' . $effectBuff);
            }

            if ($demeritId !== null && isset($demeritNameMap[$demeritId]) && $lines['merit' . $slot] !== null) {
                $demeritBuff = (int) ($relic['demerit_buff' . $slot] ?? 0);
                $lines['demerit' . $slot] = $demeritNameMap[$demeritId] . ($demeritBuff === 0 ? '' : '-' . $demeritBuff);
            }
        }

        return $lines;
    }
}

