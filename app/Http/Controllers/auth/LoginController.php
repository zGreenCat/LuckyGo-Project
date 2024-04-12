<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function store(Request $request )
    {
        $messages = makeMessages();
        //Validar datos
        
        $request->validate([
            'email' => ['required','email'],
            'password'=>['required','min:6']
        ],$messages);
        //Autenticar en base de datos
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('message','Las credenciales son incorrectas');
        }
        
        $user= DB::table('users')->where('email',$request->email)->get();
        if($user[0]->role=='A')
        {
            return redirect()->route('admin.view');
        }
        else return redirect()->route('sorter.view');
        
    }
}