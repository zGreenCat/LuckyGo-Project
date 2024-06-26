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
        $messages = makeMessageRegister();
        //Validar datos
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email', 'unique:users'],
            'age'=> 'required'
        ],$messages);
        if(!is_numeric($request->age)){return back()->with('message','La edad del sorteador debe ser numérica');}
        if(intval($request->age) < 18 || intval($request->age) > 65 ){return back()->with('message','La edad del sorteador no puede ser inferior a 18 y mayor a 65');}
        //Creacion contrasena aleatoria
        $password = rand(99999,999999);
        
        $user = $request->name;
        //Correo con contrasena enviada
        try {
            
            Mail::to($request->email)->send(new PasswordMailable($user, $password));
        } catch (\Exception $e) {

            return redirect()->route('admin.view')->with('error','error');
        }

        User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'age'=>$request->age,
            'role'=>'S',
            'stat' => true,
            'lotcant' => '0',
        ]);

        return redirect()->route('admin.view')->with('success','success');
        
    }
}
