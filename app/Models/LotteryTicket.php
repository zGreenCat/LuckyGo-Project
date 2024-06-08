<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticketID',
        'selectedNumbers',
        'price',
        'luck',
        'date',
        'rafflesid',
    ];

    public function raffle()
    {
        return $this->belongsTo('App\Models\Raffle');
    }
}
