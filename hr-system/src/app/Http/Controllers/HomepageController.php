<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:ROLE_ADMIN');
    // }

    public function index() {
        if(Auth::id())
        {
            $role = Auth()->user()->role;

            if($role=='Staff')
            {
                return view('homepage.index');
            }

            else if($role=='Admin')
            {
                return view('admin.dashboard');
            }
            else if($role=='Manager')
            {
                return view('homepage.index');
            }
        }
    }


    // public function index() {
    //     return view('homepage.index');
    // }
}
