<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baranginventaris extends Model
{
    use HasFactory;
    protected $table = 'barang_inventaris';

    protected $fillable = ['nama_barang', 'merk_barang', 'qty', 'kondisi', 'tanggal_pengadaan'];
}
