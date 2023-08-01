<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index() {
        return view('admin.attendance');
    }

    public function storeattendance()
    {
        $attendanceData = Attendance::all();

        return view('admin.attendance', ['attendanceData' => $attendanceData]);

    }
}
