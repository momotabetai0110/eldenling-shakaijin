<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presets', function (Blueprint $table) {
            $table->bigIncrements('preset_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->foreignId('vessel_id')->constrained('vessels', 'vessel_id')->cascadeOnDelete();
            $table->foreignId('relic_id1')->nullable()->constrained('relics', 'relic_id')->nullOnDelete();
            $table->foreignId('relic_id2')->nullable()->constrained('relics', 'relic_id')->nullOnDelete();
            $table->foreignId('relic_id3')->nullable()->constrained('relics', 'relic_id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presets');
    }
};