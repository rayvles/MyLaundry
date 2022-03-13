<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    private $id_outlet;

    public function setOutletId($id){
        $this->id_outlet= $id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([
            'id_outlet' => $this->id_outlet,
            'name'     => $row['name'],
           'email'    => $row['email'], 
           'password' => Hash::make($row['password']),
           'role'    => $row['role'], 
        ]);

       
    }
    
}
