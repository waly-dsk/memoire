<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function getloginform()
    {
        return view('auth.login');
    }
    public function getpasswordresetform()
    {
        return view('auth.reset_password');
    }

    public function reset_perform(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email', 'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'email.required' => 'Adresse e-mail requise',
            'email.email' => 'Adresse e-mail invalide',
            'password.required' => "Le mot de passe est obligatoire",
            'confirm_password' => 'required|same:password', 'password.required' => "Veuillez saisir un mot de passe.",
            'password.min' => "Le mot de passe doit faire 8 caractères au minimum.",
            'confirm_password.required' => 'Veuillez confirmer votre mot de passe.',
            'confirm_password.same' => 'Mots de passe non conformes.',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Adresse e-mail non trouvée']);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
    }

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
