<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    /**
     * Attribut Yang Harus dilindungi untuk table PenjemputanLaundry.
     *
     */
    protected $table = 'tb_paket';

     /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Paket
     *
     */
    protected $fillable = ['nama_paket', 'jenis', 'harga'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
}
