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
        $request->validate([
            'name' => 'required',
            'email' => ['required','email', 'unique:users'],
            'age'=> 'required'
        ],$messages);
        $password = rand(99999,999999);
        User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'age'=>$request->age,
            'role'=>'S',
        ]);
        $user = $request->name;
        Mail::to($request->email)->send(new PasswordMailable($user ,$password));
        return redirect()->route('admin.view');
        
    }
}
