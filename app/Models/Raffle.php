<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;
    protected $fillable = [
        'sunday',
        'stat',
        'cant_tickets',
        'cant_tickets_luck',
        'won',
        'won_luck',
        'sorter_name',
    ];


    //Relacion uno a muchos
    public function tickets()
    {
        return $this->hasMany('App\Models\LotteryTicket');
    }
}
