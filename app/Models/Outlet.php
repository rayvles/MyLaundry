<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
   
    use HasFactory;

    protected $table = 'tb_outlet';

    protected $fillable = ['nama', 'telepon', 'alamat'];

    public function paket() {
        return $this->hasMany(Paket::class, 'id_outlet');
    }

   
}
