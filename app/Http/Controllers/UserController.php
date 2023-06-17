<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')
            ->orderBy('role')
            ->paginate(1);

        return view('users.index', [
            'user' => Auth::user(),
            'agents' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form', [
            'user' => Auth::user(),
            'agent' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Le nom de l\'agent est obligatoire.',
            'email.required' => 'L\'adresse mail est obligatoire.',
            'role.required' => 'Le champ rôle est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);

        $hashedPassword = Hash::make($validatedData['password']);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => $hashedPassword,
        ]);

        return to_route('user.index')->with('success', 'Agent bien ajouté !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agent = User::findOrFail($id);
        return view('users.form', [
            'user' => Auth::user(),
            'agent' => $agent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $agent = User::findOrFail($id);

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ];

        $messages = [
            'name.required' => 'Le nom de l\'agent est obligatoire.',
            'email.required' => 'L\'adresse mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ];

        if ($agent->role != "admin") {
            $rules['role'] = 'required';
            $messages['role.required'] = 'Le champ rôle est obligatoire.';
        }

        $validatedData = $request->validate($rules, $messages);

        $hashedPassword = Hash::make($validatedData['password']);
        $dataToUpdate = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
        ];

        if ($agent->role != "admin") {
            $dataToUpdate['role'] = $validatedData['role'];
        }

        $agent->update($dataToUpdate);

        return to_route('user.index')->with('success', 'Informations mises à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agent = User::findOrFail($id);
        if ($agent->role == "admin")
            return redirect()->back()->with('error', 'Vous ne pouvez supprimer l\'Administrateur !');
        $agent->delete();
        return redirect()->back()->with('success', 'Agent supprimé avec succès !');
    }
}
