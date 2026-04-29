<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemeritMaster extends Model
{
    protected $table = 'demerit_masters';

    protected $primaryKey = 'demerit_id';

    protected $fillable = [
        'demerit_name',
        'is_status',
    ];
}

