<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'user' => Auth::user() ?: new User(),
            'categories' => DB::table('categories')->paginate(5),
        ]);
    }


    public function show($id)
    {
        $categorie = DB::table('categories')->where('id', '=', $id)
            ->select('classe as category_classe', 'intitule as category_intitule')
            ->first();
        $divisions = DB::table('categories')
            ->join('divisions', 'categories.id', '=', 'divisions.category_id')
            ->where('divisions.category_id', '=', $id)
            ->select(
                'divisions.classe as division_classe',
                'divisions.intitule as division_intitule'
            )
            ->paginate(5);

        return view('category.show', [
            'user' => Auth::user() ?: new User(),
            'categorie' => $categorie,
            'divisions' => $divisions,
        ]);
    }
}
