<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Hardcoded credentials
        $validEmail = 'admin@gmail.com';
        $validPassword = 'admin';

        if ($email === $validEmail && $password === $validPassword) {
            session(['logged_in' => true, 'user_email' => $email]);
            return redirect('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
