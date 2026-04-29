<?php

namespace App\Http\Controllers;

use App\Services\PlayGachaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class PlayGachaController extends Controller
{
    public function play(Request $request, PlayGachaService $playGachaService): JsonResponse
    {
        $validated = $request->validate([
            'user_uuid' => ['required', 'uuid'],
            'use_ticket_count' => ['required', 'integer', 'min:1'],
            'item_type_flag' => ['required', 'integer', 'in:0,1'],
        ]);

        try {
            $result = $playGachaService->play(
                $validated['user_uuid'],
                (int) $validated['use_ticket_count'],
                (int) $validated['item_type_flag']
            );
        } catch (RuntimeException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json($result);
    }
}

