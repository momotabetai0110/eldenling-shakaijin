<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('relics', 'is_fovarite') && !Schema::hasColumn('relics', 'is_favorite')) {
            DB::statement('ALTER TABLE `relics` RENAME COLUMN `is_fovarite` TO `is_favorite`');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('relics', 'is_favorite') && !Schema::hasColumn('relics', 'is_fovarite')) {
            DB::statement('ALTER TABLE `relics` RENAME COLUMN `is_favorite` TO `is_fovarite`');
        }
    }
};

