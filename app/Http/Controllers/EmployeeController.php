<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(EmployeeDataTable $dataTable)
    {
//        $data = Employee::get()->limit(10);
//        print_r($data);
        return $dataTable->render('employee');
    }


}
