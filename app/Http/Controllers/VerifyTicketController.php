<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\VerifyTicket;
use App\Models\LotteryTicket;
use Illuminate\Http\Request;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;

class VerifyTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.verifyTicket');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = makeMessageVerifyTicket();
        //Validar datos
        $request->validate([
            'ticketID' => 'required|exists:lottery_tickets,ticketID',
        ],$messages);

        
        $ticketID = $request->ticketID;
        $ticket = LotteryTicket::where('ticketID', $ticketID)->first();
        $raffle = Raffle::where('id', $ticket->rafflesid)->first();

        if ($raffle->stat == 1 ||$raffle->stat == -1){
            return back()->with('message','El sorteo asociado a este billete aún no ha sido realizado.');
        }
        $ticketCount = LotteryTicket::where('selectedNumbers', $raffle->won)
                            ->where('rafflesid',$raffle->id )
                            ->where('luck',false)
                            ->count();
        $ticketCountLuck = LotteryTicket::where('selectedNumbers', $raffle->won_luck)
                            ->where('rafflesid',$raffle->id )
                            ->where('luck',true)
                            ->count();
        $ticketDate = Carbon::parse($ticket->date);
        $formattedTicket = $ticketDate->format('d-m-Y');
        $ticket->formatted_date = $formattedTicket;
        $sundayDate = Carbon::parse($raffle->sunday);
        $formattedSunday = $sundayDate->format('d-m-Y');
        $ticket->formatted_sunday = $formattedSunday;
        return view('client.verifyTicket',[
            'ticket'=>$ticket, 'raffle'=>$raffle,'ticketCount'=>$ticketCount,'ticketCountLuck'=>$ticketCountLuck,
        ]);    
    }

    /**
     * Display the specified resource.
     */
    public function show(VerifyTicket $verifyTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VerifyTicket $verifyTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VerifyTicket $verifyTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VerifyTicket $verifyTicket)
    {
        //todo el proyecto de luckygo
    }
}
