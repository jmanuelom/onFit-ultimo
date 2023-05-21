<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Authenticatable implements AuthenticatableContract
{
    use \Illuminate\Auth\Authenticatable;
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'password',
        'level',
        'subscription',
        'image',
        'birthdate'

    ];

    use HasFactory;
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
