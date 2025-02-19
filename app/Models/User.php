<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role_id',
        'is_admin',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function hasAnyRole($roles)
    {
        if (!is_array($roles)){
            $roles=[$roles];
        }
        foreach ($roles as $role){
            if (strtolower($role)===strtolower($this->role->name)){
                return true;
            }
        }
        return false;
    }
}
