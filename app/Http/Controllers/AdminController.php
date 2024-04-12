<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('role','S')->get();
        return view('admin.index',[
            'users'=> $users
        ]);
    }
    public function search(Request $request)
    {
        $users= DB::table('users')->where('name',$request->search)->orWhere('email',$request->search)->get();
        return view('admin.index',[
            'users'=>$users
        ]);
        
    }
}
