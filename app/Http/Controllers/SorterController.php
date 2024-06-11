<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SorterController extends Controller
{
    public function index()
    {
        $raffles = Raffle::orderBy('sunday')->with('user')->get();
        $now = new \DateTime();
        $dayOfWeek = $now->format('w');
        if ($now->format('w') != 0) {
            $now->modify('next Sunday');
        } 
        
        $formatedLastSunday = $now->format('Y-m-d');
        foreach($raffles as $raffle)
        {
           
            if($raffle->sunday < $formatedLastSunday && $raffle->stat == 1)
            {
                $raffle->stat = -1; 
                $raffle->save();
            }
        }
        return view('sorter.index',[
            'raffles'=> $raffles
        ]);
    }
    public function registerRaffle(Request $request)
    {
        $now = new DateTime();
        $user = Auth::user();
        $raffle = Raffle::where('sunday', $request->sunday)->first();
        $raffle->won = $request->selectedNumbers1;
        $raffle->usersEmail = $user->email;
        $raffle->stat = 0;
        $raffle->timeRegister = $now->format('Y-m-d H:i:s');
        $raffle->save();
        if($raffle->cant_tickets_luck>0)
        {
            $raffle->won_luck = $request->selectedNumbers2;
            $raffle->save();
        }
        return redirect()->route('sorter.view');
    }
}

