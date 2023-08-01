<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Department;

class JobController extends Controller
{

    public function index()
    {
        $jobs = Job::has('department')->get();
        return view('admin.job')->with(['jobs' => $jobs]);
    }

    public function create()
    {
        $departments = Department::pluck('name', 'id');
        return view('admin.create', compact('departments'));
    }

    public function store(Request $request) {
        Job::create($request->all());
        return redirect()->route('admin.job')->with('success', 'Job added successfully!');
    }

//     public function getJobsByDepartment($departmentId)
// {
//     $jobs = Job::where('department_id', $departmentId)->get();
//     return response()->json($jobs);
// }

    
}
