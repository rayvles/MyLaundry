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
     * Attribut Yang Harus dilindungi untuk table Users.
     *
     */
    protected $table = 'users';
    
    /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Users
     *
     */
    protected $fillable = [
        'id_outlet',
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * Attribut Yang Harus disembunyikn untuk serialize.
     *
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Membuat Function Relasi ke Table Outlet Dengan Mengisi id_outlet dari id outlet.
     *
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    
    
    
}
