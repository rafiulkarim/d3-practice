<?php

namespace App\Http\Controllers;

use App\Models\DivisionGeojson;
use Illuminate\Http\Request;

class DivisionGeojsonController extends Controller
{
    public function index(){
        $data = DivisionGeojson::all();
        return response()->json(['division'=>$data]);
    }
}
