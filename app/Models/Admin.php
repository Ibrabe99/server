<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'created_at',
        'updated_at',
    ];

    // public function isAdmin()
    // {
    //     return $this->role === 'admin';
    // }

    protected $hidden = [
        'password',
        'remember_token',
    ];



}
