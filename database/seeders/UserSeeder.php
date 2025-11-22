<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'muhammadazeim22'.'@gmail.com',//
            'password' => Hash::make('123456'),
            'name' => 'abu bakar',//
            'phone' => '0148254347',//
            'role' => 1,
            'date_register' => '2024-10-19 00:44:09',
            'email_verified_at' => '2024-10-20 00:10:50',
            'key' => Str::random(32),
        ]);

        DB::table('companies')->insert([
            'logo' => 'logo.jpg',//

        ]);

    }//end method run

}//end class
