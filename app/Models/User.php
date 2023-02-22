<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nim',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNicknameAttribute()
    {
        $name = explode(' ', $this->name);
        if (count($name) === 1) {
            return $name[0];
        }
        if (strlen($name[0]) < 3) {
            return $name[1];
        }
        if (str_contains($name[0], '.')) {
            return $name[1];
        }
        if (str_contains(strtolower($name[0]), 'muh')) {
            return $name[1];
        }
        return $name[0];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
