<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);
        
        if (!Auth::attempt($data, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Неверный email или пароль'
            ]);
        }
        
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
