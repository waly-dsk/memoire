<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function get_options($entiteId)
    {
        $options = DB::table('options')
            ->where('entite_id', '=', $entiteId)
            ->get();
        return response()->json($options);
    }

    public function get_divisions($categoryId)
    {
        $divisions = DB::table('divisions')
            ->where('category_id', '=', $categoryId)
            ->get();
        return response()->json($divisions);
    }
}
