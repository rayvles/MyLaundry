<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';

    protected $fillable = [
        'id_paket',
        'qty',
        'keterangan',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
