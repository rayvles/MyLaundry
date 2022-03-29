<?php

namespace App\Imports;

use App\Models\Outlet;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OutletImport implements  ToModel
{
    /**
     * Membuat Function Untuk Memasukan data yang akan di import ke database
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        return new Outlet([
            'nama' => $row[0],
            'telepon' => $row[1],
            'alamat' => $row[2],

        ]);

    }


}
