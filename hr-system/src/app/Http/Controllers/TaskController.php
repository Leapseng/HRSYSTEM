<?php

namespace App\Http\Controllers;

use App\Models\Admin\Task;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // public function index() {

    //     if(Auth::id())
    //     {
    //         $role = Auth()->user()->role;

    //         if($role=='Staff')
    //         {
    //             $tasks = Task::all();
    //             return view('task.index')->with('tasks', $tasks);
    //         }

    //         else if($role=='Manager')
    //         {
    //             $tasks = Task::all();
    //             return view('task.manager')->with('tasks', $tasks);
    //         }

    //         else if($role=='Admin')
    //         {
    //             return view('admin.dashboard');
    //         }
    //     }
    // }
    public function index()
{
    if (Auth::check()) {
        $role = Auth::user()->role;

        if ($role == 'Staff') {
            $userTasks = Task::where('user_id', Auth::id())->get();
            return view('task.index')->with('tasks', $userTasks);
        } elseif ($role == 'Manager') {
            $tasks = Task::all();
            return view('task.manager')->with('tasks', $tasks);
        } elseif ($role == 'Admin') {
            return view('admin.dashboard');
        }
    }

    // Handle other cases or show error if not logged in
    return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
}

public function submission(Request $request)
{
    // Generate a unique key for this task submission based on task_id and user_id
    $submissionKey = $request->task_id . '_' . auth()->id();

    // Check if the user has already submitted a file for this task
    if (session()->has($submissionKey)) {
        return redirect()->back()->with('error', 'You have already submitted the file for this task.');
    }

    // Validate the file submission
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);

    try {
        $names = uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->storeAs('public/task_files', $names);

        Submission::create([
            'task_id' => $request->task_id,
            'user_id' => auth()->id(),
            'file' => $names,
            'submission_key' => $submissionKey,
        ]);

        // Mark this task submission as submitted in the session
        session()->put($submissionKey, true);

        return redirect()->route('task.index')->with('success', 'Turned in');
    } catch (\Exception $exception) {
        return redirect()->back()->with('error', 'An error occurred while submitting the file.');
    }
}

    

public function store(Request $request)
{
    DB::beginTransaction();
    try {
        $names = uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->storeAs('public/project', $names);
        Task::create([
            'user_id'=> $request->user_id,
            'name' => $request->name,
            'due_date' => $request->due_date,
            'description' => $request->description,
            'file' => $names,
        ]);
        DB::commit();
    } catch (\Exception $exception) {
        DB::rollBack();
        return $exception->getMessage();
    }
    return redirect()->route('task.manager')->with('success', 'Task added successfully.');
}
}
