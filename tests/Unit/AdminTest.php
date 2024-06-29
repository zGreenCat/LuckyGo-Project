<?php

namespace Tests\Unit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
class AdminTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    public function testAdminRegisterSorter(): void
    {
        $admin= User::factory()->create([
            'name' => 'Antonio Barraza Guzmán',
            'email' => 'antonio.barraza.guzman@gmail.com',
            'password' => Hash::make('Luckygo23'),
            'role' => 'A',
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ]);
        
        $sorteadorData = [
            'name' => 'Vicente Araya Rojas',
            'email' => 'vicente.araya9821@gmail.com',
            'password' => Hash::make('1'),
            'age' => 20,
            'role' => 'S',
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ];
        
        $response = $this->actingAs($admin)->assertAuthenticated()->post(route('admin.register'), $sorteadorData);
        $this->assertDatabaseHas('users', [
            'email' => $sorteadorData['email'],
            'role' => 'S'
        ]);
    }
}
