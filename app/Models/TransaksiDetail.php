<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    /**
     * Attribut Yang Harus dilindungi untuk table Detail Transaksi.
     *
     */
    protected $table = 'tb_detail_transaksi';
    /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table DetailTransaksi
     *
     */
    protected $fillable = [
        'id_transaksi',
        'id_paket',
        'qty',
        'keterangan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
