<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Super Admin
            [
                'name' => 'Super Admin User',
                'username' => 'super admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'telp' => '082136340072',
                'role' => '0',
                'status' => '1',
            ],

            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'telp' => '082136340073',
                'role' => '1',
                'status' => '1',
            ],

            //user
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'telp' => '082136340074',
                'role' => '2',
                'status' => '1',
            ],

        ]);
    }
}
