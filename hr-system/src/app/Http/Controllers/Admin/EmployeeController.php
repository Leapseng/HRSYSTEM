<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Job;
use Illuminate\Http\Request;
use App\Models\Admin\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index() {
        $departments = Department::all();
        $employees = User::all();
        return view('admin.employee')->with('departments', $departments)->with('employees', $employees);
    }

    public function getJobs(Request $request)
    {
        $departmentId = $request->input('department_id');
        $jobs = Job::where('department_id', $departmentId)->get();
        return response()->json($jobs);

    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.create_employee', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'department' => 'required|exists:departments,id',
            'job' => 'required|exists:jobs,id',
            'role' => 'required|in:Staff,Manager,Admin',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'taskCreation')
                ->withInput();
        }

        // Upload the image if present
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid().time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('employee_images', $imageName, 'public');
        }

        // Create the employee record in the database
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
            'phone' => $request->phone,
            'address' => $request->address,
            'department' => $request->department,
            'job' => $request->job,
            'role' => $request->role,
        ]);

        // Redirect to a success page or do something else
        return redirect()->route('admin.employee')->with('success', 'Employee added successfully!');
    }

    public function show(User $employee)
    {
        return view('admin.show_employee', compact('employee'));
    }

    public function edit(User $employee)
    {
        $departments = Department::all();
        return view('admin.edit_employee', compact('employee', 'departments'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'department', 'job', 'role']);

        if ($request->has('password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->route('admin.employee', ['employee' => $employee->id])->with('success', 'Employee details updated successfully!');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employee')->with('success', 'Employee deleted successfully.');
    }

    
}
