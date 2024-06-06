<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LotteryTicket;
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
        if($luck == null) $luck = false;
        if($luck == true){
            $price = 3000;
        }else{
            $price = 2000;
        }
 
        // Crear un nuevo registro en la tabla de billetes
        LotteryTicket::create([
            'id' => $id,
            'ticketID' => $id,
            'selectedNumbers' => $selectedNumbers,
            'price' => $price,
            'luck' => $luck,

        ]);

        //dd($numbers[0]);

        return redirect()->route('buyTicket')->with('success' ,'success')->with('id' , $id);      
    }
}
