<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        return view('admin.department')->with('departments', $departments);
    }

    public function create(){
        $departments = Department::all();
        return view('admin.department.create')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        Department::create($request->all());
        return redirect()->route('admin.department')->with('success', 'Department added successfully.');
    }

    
}
