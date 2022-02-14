<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('Rayvles');
        User::create([
            'name' => 'Owner MyLaundry',
            'email' => 'RayvlesOwner@gmail.com',
            'password' => $password,
            'role' => 'owner',
        ]);

        $password = bcrypt('Rayvles');
        User::create([
            'name' => 'Admin MyLaundry',
            'email' => 'Rayvlesadmin@gmail.com',
            'password' => $password,
            'role' => 'admin',
        ]);

        $password = bcrypt('Rayvles');
        User::create([
            'name' => 'Kasir MyLaundry',
            'email' => 'RayvlesKasir@gmail.com',
            'password' => $password,
            'role' => 'kasir',
        ]);

        \App\Models\Member::factory(50)->create();
        \App\Models\Outlet::factory(50)->create();
        \App\Models\Paket::factory(50)->create();
        \App\Models\User::factory(50)->create();
    }


}
