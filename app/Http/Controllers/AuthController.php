<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Adresse e-mail requise',
            'email.email' => 'Adresse e-mail invalide',
            'password.required' => 'Mot de passe requis',
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->route('dashboard')->with(['user' => $user]);
        }
        return back()->with('error', 'Identifiants invalides');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
