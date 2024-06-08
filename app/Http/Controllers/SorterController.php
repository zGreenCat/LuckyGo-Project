<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SorterController extends Controller
{
    public function index()
    {
        $raffles = DB::table('raffles')->orderBy('sunday')->get();
        return view('sorter.index',[
            'raffles'=> $raffles
        ]);
    }
}
