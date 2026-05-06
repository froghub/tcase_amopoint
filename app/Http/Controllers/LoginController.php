<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Показываем страницу входа
    public function show()
    {
        return view('auth.login');
    }

    // 2. Проверяем данные и впускаем
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('tracker.index'); // Идем в админку
        }

        return back()->withErrors(['email' => 'Доступ закрыт']);
    }
}
