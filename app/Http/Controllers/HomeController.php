<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'user' => new User(),
        ]);
    }

    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user(),
        ]);
    }

    public function non_admin()
    {
        return view('non_admin', [
            'user' => new User(),
        ]);
    }
}
