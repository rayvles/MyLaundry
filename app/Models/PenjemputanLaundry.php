<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjemputanLaundry extends Model
{
    use HasFactory;
    protected $table = 'tb_penjemputanlaundry';
    protected $fillable = [
        'id_member',
        'petugas_penjemput',
        'status',
        ];


    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
