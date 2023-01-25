<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super',
                'username' => 'super',
                'email' => 'super@mypos.id',
                'password' => bcrypt('super12!@'),
                'role' => User::ROLE_SUPER,
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mypos.id',
                'password' => bcrypt('admin12!@'),
                'role' => User::ROLE_ADMIN,
            ],
            [
                'name' => 'Cashier',
                'username' => 'cashier',
                'email' => 'cashier@mypos.id',
                'password' => bcrypt('cashier12!@'),
                'role' => User::ROLE_CASHIER,
            ],
        ];

        User::insert($users);
    }
}
