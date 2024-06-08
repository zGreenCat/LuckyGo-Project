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
        $currentDayOfWeek = $currentDate->format('w'); 

        
        $daysUntilNextSunday = 7 - $currentDayOfWeek;

      
        if ($daysUntilNextSunday == 0) {
            $daysUntilNextSunday = 7;
        }

        $currentDate->modify('+' . $daysUntilNextSunday . ' days');
        $formtedDate = $currentDate->format('Y-m-d');
        $raffle = Raffle::where('sunday', $formtedDate)->first();
        
        if(!$raffle)
        {
            $raffle=Raffle::create([
                'sunday'=> $formtedDate,
                'stat' => true,
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
