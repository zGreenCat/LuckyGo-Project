<?php

namespace Tests\Unit;
use App\Models\LotteryTicket;
use App\Models\Raffle;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class SorterTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    public function testChangeDataSorter(): void
    {
        $sorter= User::factory()->create([
            'name' => 'Vicente Araya Rojas',
            'email' => 'vicente.araya9821@gmail.com',
            'password' => Hash::make('1'),
            'age' => 20,
            'role' => 'S',
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ]);
        $sorteadorData = [
            'name' => 'Victor Meneses Ibarra',
            'age' => 40,
        ];
        $response = $this->actingAs($sorter)->assertAuthenticated()->post(route('sorter.change'), $sorteadorData);
        $this->assertDatabaseHas('users', [
            'name' => 'Victor Meneses Ibarra',
            'age' => 40,
        ]);
    }
    public function testRegisterRaffle()
    {
        $sorter= User::factory()->create([
            'name' => 'Vicente Araya Rojas',
            'email' => 'vicente.araya9821@gmail.com',
            'password' => Hash::make('1'),
            'age' => 20,
            'role' => 'S',
            'stat' => true,
            'lotcant' => '0',
            'remember_token' => Str::random(10)
        ]);
        $sunday = new \DateTime('2023-12-03');
        $yesterday_sunday = new \DateTime('2023-12-02');
        $raffle_actual = Raffle::factory()->create([
            'sunday'=> $sunday,
            'stat'=> -1,
            'cant_tickets'=> 1,
            'cant_tickets_luck'=>0,
        ]);
        $lottery = LotteryTicket::factory()->create([
            'rafflesid'=>$raffle_actual->id,
            'luck'=> 0,
            'price'=>2000,
            'date'=>$yesterday_sunday,
        ]);
        $data = [
            'sunday'=>'2023-12-03',
            'selectedNumbers1' =>'2-4-5-10-20',
            'selectedNumbers2' =>null,
        ];
        $response = $this->actingAs($sorter)->assertAuthenticated()->post(route('sorter.register'), $data);
        $this->assertDatabaseHas('users', [
            'email' => 'vicente.araya9821@gmail.com',
            'lotcant' => 1,
        ]);
    }
}
