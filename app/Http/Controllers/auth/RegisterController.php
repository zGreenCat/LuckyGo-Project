<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        $messages = makeMessages();
        //Validar datos
        $request->validate([
            'name' => ['required', 'unique:users'],
            'email' => ['required','email', 'unique:users'],
            'age'=> 'required'
        ],$messages);
        //Creacion contrasena aleatoria
        $password = rand(99999,999999);
        //Creacion de usuario
        User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'age'=>$request->age,
            'role'=>'S',
            'stat' => true,
            'lotcant' => '0',
        ]);
        
        $user = $request->name;
        //Correo con contrasena enviada
        Mail::to($request->email)->send(new PasswordMailable($user ,$password));
        return redirect()->route('admin.view');
        
    }
}
