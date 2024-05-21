<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LotteryTicket;

class LotteryTicketController extends Controller{

    public function showForm(){
        return view('buy-ticket');
    }

    public function buyTicket(Request $request){
         // Validate the request
         $request->validate([
            'numbers' => 'required|array|size:5',
            'numbers.*' => 'required|integer|between:1,30',
            'lucky' => 'boolean',
        ]);

        // Create a new lottery ticket
        $ticket = new LotteryTicket();
        $ticket->numbers = implode(',', $request->numbers);
        $ticket->lucky = $request->lucky ? true : false;
        $ticket->price = $ticket->lucky ? 3000 : 2000;
        $ticket->save();

        // Show confirmation
        return view('ticket-confirmation', [
            'ticket' => $ticket,
        ]);
    }
}
