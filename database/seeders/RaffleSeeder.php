<?php

namespace Database\Seeders;

use App\Models\Raffle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LotteryTicket;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i <4 ; $i++) { 
            do {
                $timestamp = mt_rand(strtotime('-1 year'), strtotime('now'));
                $date = date('Y-m-d', $timestamp);
            } while (date('w', strtotime($date)) != 0); 
            $currentDate = new \DateTime();
            if($currentDate > $date){$stat = 1;}
            else $stat = -1;
            $cant_luck = rand(1, 5);
            $cant_normal = rand(0, 5);
            $raffle_actual = Raffle::factory()->create([
                'sunday'=>$date,
                'stat'=>$stat,
                'cant_tickets'=>$cant_normal,
                'cant_tickets_luck'=>$cant_luck,
            ]);
            for ($j=0; $j <$cant_luck ; $j++) { 
                LotteryTicket::factory()->create([
                    'rafflesid'=> $raffle_actual->id,
                    'date'=>$date,
                    "price" => 3000,
                    "luck" => 1,
                ]);
            }
            for ($k=0; $k <$cant_normal; $k++) { 
                LotteryTicket::factory()->create([
                    'rafflesid'=> $raffle_actual->id,
                    'date'=>$date,
                    "price" => 2000,
                    "luck" => 0,
                ]);
            }
        }
    }
}
