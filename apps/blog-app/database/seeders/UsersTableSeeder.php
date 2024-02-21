<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'username' => 'admin',
            'first_name' => 'Raymond',
            'last_name' => 'Raymundo',
            'password' => Hash::make('123456'),
            'role' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        User::Create([
            'username' => 'other_admin',
            'first_name' => 'Mond',
            'last_name' => 'Raymundo',
            'password' => Hash::make('123456'),
            'role' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }
}
