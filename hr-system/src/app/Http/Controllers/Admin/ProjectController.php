<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project');
    }

    public function create()
    {
        $project = Project::all();
        return view('admin.project.create')->with('project', $project);
    }


//     public function store(Request $request)
// {
//     // Validate the form data
//     $validatedData = $request->validate([
//         'task-name' => 'required|string|max:255',
//         'due-date-from' => 'required|date',
//         'due-date-to' => 'required|date|after_or_equal:due-date-from',
//         'description' => 'required|string',
//         'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
//     ]);

//     // Create a new project instance
//     $project = new Project();
//     $project->task_name = $validatedData['task-name'];
//     $project->due_date_from = $validatedData['due-date-from'];
//     $project->due_date_to = $validatedData['due-date-to'];
//     $project->description = $validatedData['description'];
//     $project->save();

//     // Handle file uploads if any
//     if ($request->hasFile('files')) {
//         foreach ($request->file('files') as $file) {
//             // Process each uploaded file here
//         }
//     }

//     // Redirect or return a response
//     return redirect()->route('admin.project')->with('success', 'Task added successfully.');
// }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $names = uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('public/project', $names);
            Project::create([
                'task_name' => $request->task_name,
                'due_date_from' => $request->due_date_from,
                'due_date_to' => $request->due_date_to,
                'description' => $request->description,
                'filename' => $names,
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return redirect()->route('admin.project')->with('success', 'Task added successfully.');
    }


}
