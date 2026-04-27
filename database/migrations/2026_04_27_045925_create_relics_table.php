<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relics', function (Blueprint $table) {
            $table->bigIncrements('relic_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->integer('color');

            // 効果1（必須）
            $table->foreignId('effect_id1')->constrained('effect_masters', 'effect_id');
            $table->foreignId('demerit_id1')->nullable()->constrained('demerit_masters', 'demerit_id');

            // 効果2（任意）
            $table->foreignId('effect_id2')->nullable()->constrained('effect_masters', 'effect_id');
            $table->foreignId('demerit_id2')->nullable()->constrained('demerit_masters', 'demerit_id');

            // 効果3（任意）
            $table->foreignId('effect_id3')->nullable()->constrained('effect_masters', 'effect_id');
            $table->foreignId('demerit_id3')->nullable()->constrained('demerit_masters', 'demerit_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relics');
    }
};