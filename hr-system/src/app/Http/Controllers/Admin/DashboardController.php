<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\User;
use App\Models\Admin\Job;
use App\Models\Admin\Task;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Admin\Department;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    public function index()
    {
        $employeeCount = User::count();
        $taskCount = Task::count();
        $loanCount = Loan::count();
        $departmentCount = Department::count();
        $jobCount = Job::count();
        $attendanceCount = Attendance::count();

        return view('admin.dashboard', compact('employeeCount', 'taskCount', 'loanCount', 'departmentCount', 'jobCount', 'attendanceCount'));
    }


}
