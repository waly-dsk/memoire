<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function get_options($entiteId)
    {
        $options = DB::table('options')
            ->where('entite_id', '=', $entiteId)
            ->get();
        return response()->json($options);
    }
}
