<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LotteryTicket;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;

class LotteryTicketController extends Controller{

    public function showForm(){
        return view('client.buyTicket');
    }

    public function store(Request $request){

        

        $messages = makeMessageRegister();
        //Validar datos
        $numbers = explode('-', $request->selectedNumbers);
        $long = count($numbers);
        if($long > 5){
            return redirect()->route('buyTicket')->with('error' ,'error');
        }
        
        //Crear ID

        do {
            $id = "LG" . rand(1,9) . rand(0,9) . rand(0,9);
        } while (DB::table('lottery_tickets')->where('ticketID', $id)->exists());

        $selectedNumbers = $request->input('selectedNumbers');
        $luck = $request->input('luck');
        
        $currentDate = new \DateTime();
        $dayOfWeek = $currentDate->format('N'); 
        

        if ($dayOfWeek != 7) {
            
            $currentDate->modify('next sunday');
        }
        $nextSunday = new \DateTime('2024-03-20');// $currentDate->format('Y-m-d');

        $raffle = Raffle::where('sunday', $nextSunday)->first();
        //Si el sorteo esta abierto es 1
        //Si el sorteo esta no realizado (se paso la fecha pero ningun sorteador lo registra todavia) es -1
        //Si el sorteo se realizo y se registro es 0
        if(!$raffle)
        {
            $raffle=Raffle::create([
                'sunday'=> $nextSunday,
                'stat' => 1,
                'cant_tickets' => 0,
                'cant_tickets_luck' => 0,
            ]);
        }
        if($luck == null) 
        {
            $luck = false;
        }
        if($luck == true){
            $cantCurrent =  $raffle->cant_tickets_luck;
            $raffle->cant_tickets_luck = $cantCurrent + 1;
            $raffle->save();
            $price = 3000;
        }else{
            $cantCurrent =  $raffle->cant_tickets;
            $raffle->cant_tickets = $cantCurrent + 1;
            $raffle->save();
            $price = 2000;
        }

 
        //Crear un nuevo registro en la tabla de billetes
        LotteryTicket::create([
            'ticketID' => $id,
            'selectedNumbers' => $selectedNumbers,
            'price' => $price,
            'luck' => $luck,
            'rafflesid' => $raffle->id,
        ]);

        //dd($numbers[0]);

        return redirect()->route('buyTicket')->with('success' ,'success')->with('id' , $id);      
    }
}
