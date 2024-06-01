<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('role','S')->orderBy('name')->get();
        return view('admin.index',[
            'users'=> $users
        ]);
    }
    public function search(Request $request)
    {
        
        $users= DB::table('users')->where('name',"LIKE",'%'.$request->search.'%')->orWhere('email','LIKE','%'.$request->search.'%')->orderBy('name')->get();
        return view('admin.index',[
            'users'=>$users
        ]);
        
    }
    public function changeStat(Request $request,$id)
    {
        $newStat=true;
        if($request->estado=='false'){$newStat=false;}
        $user = User::find($id);
        $user->stat = $newStat;
        $user->save();
        return redirect()->route('admin.view')->with('success2','success2');;

    }
}
