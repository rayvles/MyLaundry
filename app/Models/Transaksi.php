<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    /**
     * Attribut Yang Harus dilindungi untuk table Transaksi.
     *
     */
    protected $table = 'tb_transaksi';

     /**
     * Attribut Yang dilindungi dan akan digunakan pada saat pengisian field database table Transaksi
     *
     */
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

        /**
     * Membuat Function Untuk Membuat Kode Invoice.
     *
     */
        public static function createInvoice()
        {
            $lastNumber = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_invoice`,9,5)),0) + 1 AS last_number")->whereRaw("SUBSTRING(`kode_invoice`,1,4) = '" . date('Y') . "'")->whereRaw("SUBSTRING(`kode_invoice`,5,2) = '" . date('m') . "'")->orderBy('last_number')->first()->last_number;
            $kode_invoice = date("Ymd") . sprintf("%'.05d", $lastNumber);
            return $kode_invoice;
        }
    
    /**
     * Membuat Function Relasi Ke Detail Transaksi dengan tujuan untuk mengisi id_transaksi dari id transaksi.
     *
     */
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi');
    }

    /**
     * Membuat Function Relasi ke member dengan tujuan mengisi id_member dari member id.
     *
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    /**
     * Membuat Function Relasi ke Users.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Membuat Function Relasi Ke Outlet.
     *
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    /**
     * Membuat Function Total Harga.
     *
     */
    public function getTotalPrice()
    {
        return $this->details->reduce(function ($total, $detail) {
            return $total + ($detail->paket->harga * $detail->qty);
        });
    }

    /**
     * Membuat Function Total Discount.
     *
     */
    public function getTotalDiscount()
    {
        return $this->getTotalPrice() * ($this->diskon / 100);
    }
        public function getTotalTax()
    {
        return $this->getTotalPrice() * ($this->pajak / 100);
    }

    /**
     * Membuat Function Total Pembayaran.
     *
     */
    public function getTotalPayment()
    {
        return $this->getTotalPrice() - $this->getTotalDiscount() + $this->getTotalTax() + $this->biaya_tambahan;
    }
}


