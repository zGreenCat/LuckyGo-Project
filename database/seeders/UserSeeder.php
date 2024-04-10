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
        $data = [
            'name' => 'Antonio Barraza Guzmán',
            'email' => 'antonio.barraza.guzman@gmail.com',
            'password' => Hash::make('Luckygo23'),
            'role' => 'A',
            'remember_token' => Str::random(10)
        ];
        DB::table('users')->insert($data);
    }
}
