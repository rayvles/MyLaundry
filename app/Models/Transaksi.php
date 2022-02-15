<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        'id_outlet',
        'id_member',
        'id_user',
        'kode_invoice',
        'tgl',
        'deadline',
        'tgl_bayar',
        'biaya_tambahan',
        'diskon',
        'jenis_diskon',
        'pajak',
        'status',
        'status_pembayaran'];

    
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}


