<?php

namespace App\Http\Controllers;

use App\Models\YajraBox;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function line_chart()
    {
        return view('line-chart');
    }

    public function rfm()
    {
        return view('rfm');
    }

    public function yajra_box()
    {
//        $users = YajraBox::all();
        return view('yajra_box');
    }

    public function yajra_box_data()
    {
        $user = YajraBox::all();
        return DataTables::of($user)
//            ->filter(function ($query) {
//                if (request()->has('name')) {
//                    $query->where('name', 'like', "%" . request('name') . "%");
//                }})
//            ->addColumn('action', $data)
            ->addColumn('action', function ($user) {
                return view('data', compact('user'));
            })
            ->toJson();
    }
}
