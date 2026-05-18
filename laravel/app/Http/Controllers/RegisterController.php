<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // валидируем запрос челика на 3 поля (name, email и password)

        $data = $request->validate([
            "name" => "required|string|min:3",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8"
        ]);

        $user = User::create([
            ...$data,
            'password' => bcrypt($data['password'])
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
