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
                'sapaan' => 'Dek',
                'panggilan' => 'super admin',
                'name' => 'Super Admin User',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'telp' => '82136340071',
                'role' => '0',
                'status' => '1',
                'gender' => '0',
            ],

            //Admin
            [
                'sapaan' => 'Pak',
                'panggilan' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'telp' => '82136340072',
                'role' => '1',
                'status' => '1',
                'gender' => '0',
            ],

        ]);
    }
}
