<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EffectMaster extends Model
{
    protected $table = 'effect_masters';

    protected $primaryKey = 'effect_id';

    protected $fillable = [
        'effect_name',
        'demerit_rate',
    ];
}

