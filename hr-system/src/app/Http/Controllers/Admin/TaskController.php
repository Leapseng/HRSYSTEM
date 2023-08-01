<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // public function index() {
    //     $tasks = Task::has('user')->get();
    //     return view('admin.task')->with('tasks', $tasks);
    // }

    public function index()
{
    // Retrieve all tasks along with their user and submission data
    $tasks = Task::with('user', 'submission')->get();

    return view('admin.task', compact('tasks'));
}

    public function create()
    {
        $user = User::pluck('name', 'id');
        return view('admin.create_task')->with('user', $user);
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
        return redirect()->route('admin.task')->with('success', 'Task added successfully.');
    }

    public function download(Request $request) {
        if(Storage::disk('public')->exists("project/$request->file")) {
            $path = Storage::disk('public')->path("project/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type'=>mime_content_type($path)
            ]);
        }
        return redirect('/404');
    }

    public function download_submission(Request $request) {
        if(Storage::disk('public')->exists("task_files/$request->file")) {
            $path = Storage::disk('public')->path("task_files/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type'=>mime_content_type($path)
            ]);
        }
        return redirect('/404');
    }
}
