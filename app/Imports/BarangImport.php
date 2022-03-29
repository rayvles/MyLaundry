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
            case 'selesai':
                $status_barang = 'selesai';
                break;
            case 'belum_selesai':
                $status_barang = 'belum_selesai';
                break;
        }



        return new Barang([
            'nama_barang' => $row['nama_barang'],
            'waktu_pakai' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['waktu_pakai']),
            'waktu_beres_status' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['waktu_beres_status']),
            'nama_pemakai' => $row['nama_pemakai'],
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
            'status_barang' => Rule::in(['selesai', 'belum_selesai']),
        ];
    }
}
