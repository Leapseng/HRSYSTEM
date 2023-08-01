<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $loans = $user->loans;
    
        return view('loan.index', compact('loans'));
    }

    public function create()
    {
        return view('loan.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'loan_amount' => 'required|numeric',
    //         'reason' => 'required|string',
    //         'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    //     ]);

    //     $user = auth()->user();

    //     $file = $request->file('file');
    //     $file_path = $file->store(); // Store the file in the 'loan_files' folder within the storage/app/public directory.

    //     $loan = new Loan([
    //         'loan_amount' => $request->loan_amount,
    //         'reason' => $request->reason,
    //         'file' => $file_path, // Save the file path to the 'file' column in the 'loans' table.
    //     ]);

    //     $user->loans()->save($loan);

    //     return redirect()->route('loan.index')->with('success', 'Loan request submitted successfully!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'loan_amount' => 'required|numeric',
        'reason' => 'required|string',
        'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    $file = $request->file('file');
    $file_name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension(); // Generate a unique file name.

    $file_path = $file->storeAs('loan_files', $file_name); // Store the file with the generated unique name in the 'loan_files' folder within the storage/app/public directory.

    $loan = new Loan([
        'loan_amount' => $request->loan_amount,
        'reason' => $request->reason,
        'file' => $file_name, // Save the generated unique file name to the 'file' column in the 'loans' table.
    ]);

    $user->loans()->save($loan);

    return redirect()->route('loan.index')->with('success', 'Loan request submitted successfully!');
}

    public function download(Request $request) {
        if(Storage::disk('local')->exists("loan_files/$request->file")) {
            $path = Storage::disk('local')->path("loan_files/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type'=>mime_content_type($path)
            ]);
        }
        return redirect('/404');
    }
    public function download_public(Request $request) {
        if(Storage::disk('public')->exists("project/$request->file")) {
            $path = Storage::disk('public')->path("project/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type'=>mime_content_type($path)
            ]);
        }
        return redirect('/404');
    }

    

    // public function download(Request $request)
    // {
    //     $file = $request->query('file');
    
    //     // Check if the file exists in the storage
    //     if (Storage::disk('local')->exists("loan_files/$file")) {
    //         // Get the original file name (without the path)
    //         $fileName = basename($file);
    
    //         // Download the file
    //         $filePath = storage_path("app/loan_files/$file");
    //         return response()->download($filePath, $fileName);
    //     }
    
    //     // If the file does not exist, redirect back or show an error message
    //     return back()->with('error', 'File not found.');
    // }

    public function update(Request $request, $id)
{
    $loan = Loan::findOrFail($id);

    $request->validate([
        'status' => 'required|in:Pending,Approve,Disapprove',
    ]);

    $loan->status = $request->status;
    $loan->save();

    return redirect()->route('admin.loan')->with('success', 'Loan status updated successfully!');
}
}
