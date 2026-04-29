<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relic extends Model
{
    protected $table = 'relics';

    protected $primaryKey = 'relic_id';

    protected $fillable = [
        'user_id',
        'color',
        'effect_id1',
        'effect_buff1',
        'demerit_id1',
        'demerit_buff1',
        'effect_id2',
        'effect_buff2',
        'demerit_id2',
        'demerit_buff2',
        'effect_id3',
        'effect_buff3',
        'demerit_id3',
        'demerit_buff3',
        'is_favorite',
    ];
}

