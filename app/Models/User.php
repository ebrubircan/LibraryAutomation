<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table='student';

    protected $fillable = [
        'StudentID',
        'Name',
        'Surname',
        'Email',
        'Password',
    ];

    const UPDATED_AT = 'updated_at';


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getAuthPassword()
    {
        return $this->Password;
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
