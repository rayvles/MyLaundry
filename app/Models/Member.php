<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    /**
     * Attribut Yang Harus dilindungi untuk table Member.
     *
     */
    protected $table = 'tb_member';

    /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Member
     *
     */
    protected $fillable = ['nama', 'telepon', 'alamat', 'email', 'jenis_kelamin'];

    
}
