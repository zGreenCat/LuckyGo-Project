<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LotteryTicket;

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

        $id = "LG" . rand(1,9) . rand(0,9) . rand(0,9);

        $selectedNumbers = $request->input('selectedNumbers');
        $tendresuerte = $request->has('luck');

        // Crear un nuevo registro en la tabla de billetes
        LotteryTicket::create([
            'ticketID' => $id,
            'selectedNumbers' => $selectedNumbers,
      
        ]);

        //dd($numbers[0]);

        return redirect()->route('buyTicket')->with('success' ,'success')->with('id' , $id);      
    }
}
