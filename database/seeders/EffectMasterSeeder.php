<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EffectMasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('effect_masters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $effects = [
            ['effect_name' => '集中力',               'demerit_rate' => 3],
            ['effect_name' => '好感度',               'demerit_rate' => 3],
            ['effect_name' => '移動速度',             'demerit_rate' => 3],
            ['effect_name' => '社用PC性能',           'demerit_rate' => 3],
            ['effect_name' => '目覚めの良さ',         'demerit_rate' => 3],
            ['effect_name' => '身体能力',         'demerit_rate' => 3],
            ['effect_name' => 'PCスキル',         'demerit_rate' => 3],
            ['effect_name' => '文章力',           'demerit_rate' => 3],
            ['effect_name' => 'メンタル',             'demerit_rate' => 3],
            ['effect_name' => '忘れ物防止',           'demerit_rate' => 3],
            ['effect_name' => '睡眠の質',             'demerit_rate' => 3],
            ['effect_name' => '給料が上昇',           'demerit_rate' => 2],
            ['effect_name' => '残業代が上昇',         'demerit_rate' => 2],
            ['effect_name' => 'コンビニの買い物割引', 'demerit_rate' => 1],
            ['effect_name' => '家賃減少',             'demerit_rate' => 2],
            ['effect_name' => '昼休み中の食料品割引', 'demerit_rate' => 1],
            ['effect_name' => '出勤前の食料品割引',   'demerit_rate' => 1],
            ['effect_name' => 'スマホ代減少',         'demerit_rate' => 1],
            ['effect_name' => '賞与回数+1',           'demerit_rate' => 2],
            ['effect_name' => '出勤時、冷たい水を持つ。',     'demerit_rate' => 1],
            ['effect_name' => '出勤時、缶コーヒーを持つ',     'demerit_rate' => 1],
            ['effect_name' => '出勤時、温かいお茶を持つ',     'demerit_rate' => 1],
            ['effect_name' => '出勤時、缶ジュースを持つ',     'demerit_rate' => 1],
            ['effect_name' => '出勤時、小さいパンを持つ',     'demerit_rate' => 1],
            ['effect_name' => '出勤時、小さいおにぎりを持つ', 'demerit_rate' => 1],
            ['effect_name' => 'デスクワーク効率を強化',       'demerit_rate' => 1],
            ['effect_name' => '立ち仕事効率強化',             'demerit_rate' => 1],
            ['effect_name' => '外回り効率を強化',             'demerit_rate' => 1],
            ['effect_name' => '居眠り中、好感度上昇',         'demerit_rate' => 1],
            ['effect_name' => '挨拶する度、仕事効率上昇',     'demerit_rate' => 1],
            ['effect_name' => '怒られるとストレス減少',       'demerit_rate' => 1],
            ['effect_name' => '朝歯磨きスキップ',             'demerit_rate' => 2],
            ['effect_name' => '朝洗顔(保湿含む)スキップ',     'demerit_rate' => 2],
            ['effect_name' => '3食同じコンビニで翌日の勤務時間短縮', 'demerit_rate' => 1],
            ['effect_name' => '週の残業が10時間を超えたとき、部屋が片付く', 'demerit_rate' => 1],
            ['effect_name' => '休日出勤した日、食費無料。',   'demerit_rate' => 1],
            ['effect_name' => '公共交通機関で座りやすくなる', 'demerit_rate' => 1],
            ['effect_name' => 'エレベーターが高速で来る。',   'demerit_rate' => 1],
            ['effect_name' => '相手が考えていることがたまに分かる', 'demerit_rate' => 1],
            ['effect_name' => 'まれにヘッドハンティング',     'demerit_rate' => 1],
            ['effect_name' => '帰宅と同時に風呂が沸くことがある', 'demerit_rate' => 1],
            ['effect_name' => 'まれに移動スキップ',           'demerit_rate' => 1],
            ['effect_name' => '午前中やる気上昇、午後やる気低下',       'demerit_rate' => 0],
            ['effect_name' => '週明け労働時間減少、週末労働時間増加',   'demerit_rate' => 0],
            ['effect_name' => 'シフト制になる',               'demerit_rate' => 0],
            ['effect_name' => '土日休みになる',               'demerit_rate' => 0],
            ['effect_name' => '年下の好感度上昇、年上の好感度低下',     'demerit_rate' => 0],
            ['effect_name' => '忙しくなるが、給料増加',       'demerit_rate' => 0],
            ['effect_name' => '昼休みが30分に短縮',           'demerit_rate' => 0],
            ['effect_name' => '髪型自由',                     'demerit_rate' => 2],
            ['effect_name' => '服装自由',                     'demerit_rate' => 2],
        ];

        DB::table('effect_masters')->insert($effects);
    }
}
