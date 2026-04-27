<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->bigIncrements('vessel_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->integer('color1');
            $table->integer('color2');
            $table->integer('color3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
};