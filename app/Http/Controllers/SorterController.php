<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SorterController extends Controller
{
    public function index()
    {
        $raffles = Raffle::orderBy('sunday')->get();
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
        $user = Auth::user();
        $raffle = Raffle::where('sunday', $request->sunday)->first();
        $raffle->won = $request->selectedNumbers1;
        $raffle->sorter_name = $user->name;
        $raffle->stat = 0;
        $raffle->save();
        if($raffle->cant_tickets_luck>0)
        {
            $raffle->won_luck = $request->selectedNumbers2;
            $raffle->save();
        }
        return redirect()->route('sorter.view');
    }
}

