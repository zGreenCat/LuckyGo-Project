<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
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
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ];
        DB::table('users')->insert($data);
        
        $data = [
            'name' => 'Vicente Araya Rojas',
            'email' => 'vicente.araya9821@gmail.com',
            'password' => Hash::make('1'),
            'age' => 20,
            'role' => 'S',
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ];
        DB::table('users')->insert($data);
        

    }
}
