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
        $categories = DB::table('categories')
            ->leftJoin('divisions', 'categories.id', '=', 'divisions.category_id')
            ->select(
                'categories.id',
                'categories.classe',
                'categories.intitule',
                DB::raw('GROUP_CONCAT(divisions.id, " | ") as division_ids'),
                DB::raw('GROUP_CONCAT(divisions.classe, " | ") as division_classes'),
                DB::raw('GROUP_CONCAT(divisions.intitule, " | ") as divisions')
            )
            ->groupBy('categories.id', 'categories.classe', 'categories.intitule')
            ->orderByDesc('categories.created_at')
            ->get();

        return view('category.index', [
            'user' => Auth::user() ?: new User(),
            'categories' => $categories,
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
            ->get();

        return view('category.show', [
            'user' => Auth::user() ?: new User(),
            'categorie' => $categorie,
            'divisions' => $divisions,
        ]);
    }
}
