<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('relics', function (Blueprint $table) {
            $table->unsignedTinyInteger('effect_buff1')->nullable()->after('effect_id1');
            $table->unsignedTinyInteger('effect_buff2')->nullable()->after('effect_id2');
            $table->unsignedTinyInteger('effect_buff3')->nullable()->after('effect_id3');

            $table->unsignedTinyInteger('demerit_buff1')->nullable()->after('demerit_id1');
            $table->unsignedTinyInteger('demerit_buff2')->nullable()->after('demerit_id2');
            $table->unsignedTinyInteger('demerit_buff3')->nullable()->after('demerit_id3');

            $table->boolean('is_favorite')->default(false)->after('demerit_buff3');
        });
    }

    public function down(): void
    {
        $dropCandidates = [
            'effect_buff1',
            'effect_buff2',
            'effect_buff3',
            'demerit_buff1',
            'demerit_buff2',
            'demerit_buff3',
            'is_fovarite',
            'is_favorite',
        ];

        foreach ($dropCandidates as $column) {
            if (Schema::hasColumn('relics', $column)) {
                Schema::table('relics', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};

