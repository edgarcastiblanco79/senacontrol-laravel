<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'current_team_id' => 'int',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'current_team_id',
        'profile_photo_path',
    ];

    /**
     * Relación con la tabla usuario
     * Un user puede tener muchos registros en usuario
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'user_id', 'id');
    }
}
