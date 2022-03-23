<?php

namespace App\Imports;

use App\Models\PenjemputanLaundry;
use App\Models\Member;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenjemputanLaundryImport implements WithValidation, ToModel,  WithHeadingRow
{
    /**
    * Membuat Function Import penjemputan laundry pada saat data akan di import ke Database
    *
    * @param array $row
    *
    */
    public function model(array $row)
    {
        $gender = $row['jenis_kelamin'] === 'Laki-laki' ? 'L' : 'P';
        $memberId = null;
        $member = Member::where('nama', $row['nama_pelanggan'])->where('alamat', $row['alamat_pelanggan'])->where('jenis_kelamin', $gender)->where('telepon', $row['nomor_telepon'])->first();
        if ($member) {
            $memberId = $member->id;
        } else {
            $member = Member::create([
                'nama' => $row['nama_pelanggan'],
                'alamat' => $row['alamat_pelanggan'],
                'jenis_kelamin' => $gender,
                'telepon' => $row['nomor_telepon'],
            ]);
            $memberId = $member->id;
        }

        $status = '';
        switch ($row['status_penjemputan']) {
            case 'tercatat':
                $status = 'tercatat';
                break;
            case 'penjemputan':
                $status = 'penjemputan';
                break;
            case 'selesai':
                $status = 'selesai';
                break;
        }

        

        return new PenjemputanLaundry([
            'id_member' => $memberId,
            'petugas_penjemput' => $row['nama_petugas_penjemputan'],
            'status' => $status,
        ]);
    }

    /**
    * Membuat Function Enum status pada saat di import Penjemputan Laundry
    *
    *
    */
    public function rules(): array
    {
        return [
            'status' => Rule::in(['tercatat', 'penjemputan', 'selesai']),
        ];
    }
}
