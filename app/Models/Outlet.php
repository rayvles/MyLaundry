<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
   
    use HasFactory;

    /**
     * Attribut Yang Harus dilindungi untuk table Outlet.
     *
     */
    protected $table = 'tb_outlet';

    /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Outlet
     *
     */
    protected $fillable = ['nama', 'telepon', 'alamat'];

    /**
     * Membuat Function Relasi Ke Paket dengan tujuan mengisi id_outlet dari outlet id.
     *
     */
    public function paket() {
        return $this->hasMany(Paket::class, 'id_outlet');
    }

   
}
