<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tb_barang';

    protected $fillable = ['nama_barang', 'qty', 'harga', 'waktu_beli', 'supplier', 'status_barang', 'waktu_updated_status'];

}
