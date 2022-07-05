<?php

namespace App\Http\Controllers;

use App\Models\Simplegraph;
use Illuminate\Http\Request;

class SimplegraphController extends Controller
{
    public function index(){
        return view('simplechart');
    }

    public function simple_chart()
    {
        $data = Simplegraph::get();
        return response()->json(['data' => $data]);
    }
}
