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

        //Crear ID
        $id = "LG" . rand(1,9) . rand(0,9) . rand(0,9);

        $selectedNumbers = $request->input('selectedNumbers')[1];
        $tendresuerte = $request->has('tendresuerte');

        // Crear un nuevo registro en la tabla de billetes
        LotteryTicket::create([
            'ticketID' => $id,
            'selectedNumbers' => $selectedNumbers,
      
        ]);
        return redirect()->route('main');
    }
}
