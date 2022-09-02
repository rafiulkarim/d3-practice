<?php

namespace App\Http\Controllers;

use App\Models\GmpGirls;
use App\Models\GmpHeight;
use Illuminate\Http\Request;

class GmpGirlsController extends Controller
{
    public function index()
    {
        return view('girls-gmp-card');
    }

    public function gmp_data()
    {
        $gmpData = GmpGirls::all();
        $gmpHeight = GmpHeight::all();
//        print_r($gmpHeight); die();
        return response()->json(['gmpData' => $gmpData, 'gmpHeight' => $gmpHeight]);
    }
}
