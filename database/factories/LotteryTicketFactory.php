<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LotteryTicket>
 */
class LotteryTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $luck = fake()->boolean;
        if($luck){$price = 3000;}
        else $price = 2000;
        $numbers = range(1, 30);
        shuffle($numbers);
        $selectedNumbers = array_slice($numbers, 0, 5); 
        sort($selectedNumbers); 
        $prefix = "LG";
        $number = mt_rand(100,999);
        return [
            "ticketID" => $prefix . $number,
            "selectedNumbers" => implode('-', $selectedNumbers),
            "price" => $price,
            "luck" => $luck,
            "date"=>fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
