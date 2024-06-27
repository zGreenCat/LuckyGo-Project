<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\User;
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
    public function store(Request $request)
    {
        $messages = makeMessageRegister();
        $request->validate([
            'name' => 'required|max:255',
            'age'=> 'required'
        ],$messages);
        if(!is_numeric($request->age)){return back()->with('message','La edad del sorteador debe ser numérica');}
        if(intval($request->age) < 18 || intval($request->age) > 65 ){return back()->with('message','La edad del sorteador no puede ser inferior a 18 y mayor a 65');}
        $user = Auth::user();
        $user = User::find($user->id);
        $user->name = $request->name;
        $user->age = $request->age;
        $user->save();
        return redirect()->route('sorter.view')->with('success','success');
    
    }
    public function registerRaffle(Request $request)
    {
        $now = new DateTime();
        $user = Auth::user();
        $user = User::find($user->id);
        $cantlot_actual = $user->lotcant;
        $user->lotcant = (1+$cantlot_actual);
        $user->save();
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

