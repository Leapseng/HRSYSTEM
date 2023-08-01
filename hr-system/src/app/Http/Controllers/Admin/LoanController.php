<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index() {
        $loans = Loan::all();
        return view('admin.loan')->with('loans', $loans);
    }
}
