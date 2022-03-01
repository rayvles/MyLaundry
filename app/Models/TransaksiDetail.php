<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';
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
}
