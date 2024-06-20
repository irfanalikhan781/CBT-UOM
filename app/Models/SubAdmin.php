<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'department'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
