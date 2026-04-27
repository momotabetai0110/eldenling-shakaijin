<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'ticket',
        'user_uuid',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $user): void {
            if (empty($user->user_uuid)) {
                $user->user_uuid = (string) Str::uuid();
            }
        });
    }

    public static function createFirstLoginUser(string $userName): self
    {
        return self::create([
            'user_name' => $userName,
        ]);
    }
}
