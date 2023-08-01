<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $attendanceData = Attendance::where('name', $user->name)->get();
        return view('attendance.index', ['attendanceData' => $attendanceData]);
    }



    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has already submitted their attendance for the day
        $existingAttendance = Attendance::where('name', $user->name)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'You have already submitted your attendance for today.');
        }

        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->name = $user->name;
        $attendance->created_at = now(); // Or you can use a specific date and time value

        // Save the attendance record
        $attendance->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.attendance');
    }

   
}
