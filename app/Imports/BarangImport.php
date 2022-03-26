<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BarangImport implements WithValidation, ToModel,  WithHeadingRow
{
    /**
     * Membuat Function Untuk Memasukan data yang akan di import ke database
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $status_barang = '';
        switch ($row['status_barang']) {
            case 'diajukan_beli':
                $status_barang = 'diajukan_beli';
                break;
            case 'habis':
                $status_barang = 'habis';
                break;
            case 'tersedia':
                $status_barang = 'tersedia';
                break;
        }



        return new Barang([
            'nama_barang' => $row['nama_barang'],
            'qty' => $row['qty'],
            'harga' => $row['harga'],
            'waktu_beli' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['waktu_beli']),
            'supplier' => $row['supplier'],
            'status_barang' => $status_barang,
        ]);

    }

    /**
    * Membuat Function Enum status pada saat di import Data Barang
    *
    *
    */
    public function rules(): array
    {
        return [
            'status_barang' => Rule::in(['diajukan_beli', 'habis', 'tersedia']),
        ];
    }
}
