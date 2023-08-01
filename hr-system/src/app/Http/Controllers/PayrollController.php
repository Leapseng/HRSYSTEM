<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
{
    // Get the logged-in user
    $user = Auth::user();

    // Get the payroll data for the logged-in user
    $payroll = $user->payrolls;

    return view('payroll.index', compact('payroll'));
}
}
