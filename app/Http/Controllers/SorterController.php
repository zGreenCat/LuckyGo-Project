<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        dd($request);
    }
}
