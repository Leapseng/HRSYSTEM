<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/home', [HomepageController::class, 'index'])->middleware('user')->name('home.index');

Route::get('/attendance', [AttendanceController::class, 'index'])->middleware('user')->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->middleware('user')->name('attendance.store');
Route::delete('admin/attendance/{attendance}', [App\Http\Controllers\AttendanceController::class, 'destroy'])->name('attendance.destroy');

Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->middleware('user')->name('task.index');
Route::post('/task', [App\Http\Controllers\TaskController::class, 'submission'])->middleware('user')->name('task.submission');
Route::get('download/', [TaskController::class, 'download'])->name('task.download');

Route::get('/payroll', [PayrollController::class, 'index'])->middleware('user')->name('payroll.index');

Route::get('/loan', [App\Http\Controllers\LoanController::class, 'index'])->middleware('user')->name('loan.index');
Route::get('/loan/create', [LoanController::class, 'create'])->name('loan.create');
Route::post('/loan', [LoanController::class, 'store'])->name('loan.store');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');

Route::get('admin/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'storeattendance'])->middleware('admin')->name('admin.attendance');

Route::get('admin/task', [App\Http\Controllers\Admin\TaskController::class, 'index'])->middleware('admin')->name('admin.task');
Route::get('admin/task/create', [App\Http\Controllers\Admin\TaskController::class, 'create'])->middleware('admin')->name('task.create');
Route::post('admin/task', [App\Http\Controllers\Admin\TaskController::class, 'store'])->middleware('admin')->name('task.store');

Route::get('admin/department', [App\Http\Controllers\Admin\DepartmentController::class, 'index'])->middleware('admin')->name('admin.department');
Route::get('admin/department/create', [App\Http\Controllers\Admin\DepartmentController::class, 'create'])->middleware('admin')->name('department.create');
Route::post('admin/department', [App\Http\Controllers\Admin\DepartmentController::class, 'store'])->middleware('admin')->name('department.store');

Route::get('admin/job', [App\Http\Controllers\Admin\JobController::class, 'index'])->middleware('admin')->name('admin.job');
Route::get('admin/create', [App\Http\Controllers\Admin\JobController::class, 'create'])->middleware('admin')->name('job.create');
Route::post('admin/job', [App\Http\Controllers\Admin\JobController::class, 'store'])->middleware('admin')->name('job.store');

Route::get('admin/employee', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->middleware('admin')->name('admin.employee');
Route::get('admin/employee/create', [EmployeeController::class, 'create'])->middleware('admin')->name('employee.create');
Route::post('admin/employee', [EmployeeController::class, 'store'])->middleware('admin')->name('employee.store');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');

Route::get('/form/get-jobs', [EmployeeController::class, 'getJobs']);

Route::put('admin/dashboard/{user}', [DashboardController::class, 'update'])->middleware('admin')->name('admin.user.update');

Route::get('admin/payroll', [App\Http\Controllers\Admin\PayrollController::class, 'index'])->middleware('admin')->name('admin.payroll');
Route::get('admin/payroll/create', [App\Http\Controllers\Admin\PayrollController::class, 'create'])->middleware('admin')->name('payroll.create');
Route::post('admin/payroll', [App\Http\Controllers\Admin\PayrollController::class, 'store'])->middleware('admin')->name('payroll.store');

Route::get('download/', [LoanController::class, 'download'])->name('loan.download');
Route::get('download/public', [LoanController::class, 'download_public'])->name('task.download');
Route::get('download/submission', [App\Http\Controllers\Admin\TaskController::class, 'download_submission'])->name('submission.download');

Route::get('admin/loan', [App\Http\Controllers\Admin\LoanController::class, 'index'])->middleware('admin')->name('admin.loan');
Route::put('/admin/loan/{id}', [LoanController::class, 'update'])->middleware('admin')->name('loan.update');


Route::middleware('auth')->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
