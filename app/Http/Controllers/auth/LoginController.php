<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function store(Request $request )
    {
        $messages = makeMessagesLogin();
        //Validar datos
        
        $request->validate([
            'email' => ['required'],
            'password'=>['required']
        ],$messages);
        //Autenticar en base de datos
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('message','Usuario no registrado o contraseña incorrecta');
        }
        
        $user= DB::table('users')->where('email',$request->email)->get();
        if($user[0]->role=='A')
        {
            return redirect()->route('admin.view');
        }
        else{
            if($user[0]->stat==0){
                return back()->with('message','El usuario esta deshabilitado');
            }
            return redirect()->route('sorter.view');
        } 
        
    }
}