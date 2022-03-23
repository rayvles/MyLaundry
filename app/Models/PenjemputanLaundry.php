<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjemputanLaundry extends Model
{
    use HasFactory;
    /**
     * Attribut Yang Harus dilindungi untuk table PenjemputanLaundry.
     *
     */
    protected $table = 'tb_penjemputanlaundry';
    /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Penjemputan Laundry
     *
     */
    protected $fillable = [
        'id_member',
        'petugas_penjemput',
        'status',
        ];


        /**
     * Membuat Function Relasi ke member dengan tujuan mengisi id_member dari member id.
     *
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
