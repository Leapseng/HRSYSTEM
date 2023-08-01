<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Payroll;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function index() {
        $payroll = Payroll::has('user')->get();
        return view('admin.payroll', compact('payroll'));
    }

    public function create(User $user)
    {
        $user = User::pluck('name', 'id');
        return view('admin.create_payroll', compact('user'));
    }

    public function store(Request $request)
{

    Payroll::create($request->all());

    return redirect()->route('admin.payroll')->with('success', 'Payroll added successfully!');
}
}
