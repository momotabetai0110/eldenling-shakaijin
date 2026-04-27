<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('user_uuid')->nullable()->after('user_id');
        });

        DB::table('users')
            ->whereNull('user_uuid')
            ->orderBy('user_id')
            ->chunkById(200, function ($users) {
                foreach ($users as $user) {
                    DB::table('users')
                        ->where('user_id', $user->user_id)
                        ->update(['user_uuid' => (string) Str::uuid()]);
                }
            }, 'user_id');

        Schema::table('users', function (Blueprint $table) {
            $table->unique('user_uuid');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['user_uuid']);
            $table->dropColumn('user_uuid');
        });
    }
};

