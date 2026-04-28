<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemeritMasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('effect_masters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $demerits = [
            // is_status = false（ステータス系でない）
            ['demerit_name' => '電車が遅延しやすくなる',           'is_status' => false],
            ['demerit_name' => 'クレームが発生しやすくなる',     'is_status' => false],
            ['demerit_name' => '備品破損しやすくなる',           'is_status' => false],
            ['demerit_name' => '休日出勤が発生しやすくなる',     'is_status' => false],
            ['demerit_name' => 'ハラスメント増加',               'is_status' => false],
            ['demerit_name' => 'スマホバッテリー消費増加',       'is_status' => false],
            ['demerit_name' => '体調を崩しやすくなる',           'is_status' => false],
            ['demerit_name' => 'ccメール増加',                   'is_status' => false],
            ['demerit_name' => 'まれに仕事の進捗半減',           'is_status' => false],
            ['demerit_name' => '通勤に電車・バス使用禁止',     'is_status' => false],
            ['demerit_name' => '通勤に自家用車使用禁止',         'is_status' => false],
            ['demerit_name' => '勤務中空調禁止',                 'is_status' => false],
            ['demerit_name' => 'ロッカー類禁止',                 'is_status' => false],
            ['demerit_name' => '電子マネー禁止',                 'is_status' => false],
            ['demerit_name' => '現金禁止',                       'is_status' => false],
            ['demerit_name' => '残業代が低下',                   'is_status' => false],
            ['demerit_name' => 'バス・電車運賃上昇',             'is_status' => false],
            ['demerit_name' => '残業代廃止(固定残業代含む)',     'is_status' => false],

            // is_status = true（ステータス系）
            ['demerit_name' => '集中力',       'is_status' => true],
            ['demerit_name' => '好感度',       'is_status' => true],
            ['demerit_name' => '移動速度',     'is_status' => true],
            ['demerit_name' => '社用PC性能',   'is_status' => true],
            ['demerit_name' => '目覚めの良さ', 'is_status' => true],
            ['demerit_name' => '身体能力',     'is_status' => true],
            ['demerit_name' => 'PCスキル',     'is_status' => true],
            ['demerit_name' => '文章力',       'is_status' => true],
            ['demerit_name' => 'メンタル',     'is_status' => true],
            ['demerit_name' => '忘れ物防止',   'is_status' => true],
            ['demerit_name' => '睡眠の質',     'is_status' => true],
            ['demerit_name' => '徐々に部屋が汚くなる',       'is_status' => false],
            ['demerit_name' => '信号がすべて赤になる',     'is_status' => false],
            ['demerit_name' => '月曜日のストレス増加',       'is_status' => false],
            ['demerit_name' => '年間休日減少',               'is_status' => false],
            ['demerit_name' => 'トラブル遭遇率上昇',         'is_status' => false],
            ['demerit_name' => '休日に連絡がきやすくなる',   'is_status' => false],
            ['demerit_name' => '失言増加',                   'is_status' => false],
        ];

        DB::table('demerit_masters')->insert($demerits);
    }
}