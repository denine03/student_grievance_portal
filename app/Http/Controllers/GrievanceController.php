<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrievanceController extends Controller
{
    // 1. Show the form
    public function create()
    {
        return view('student.create-grievance');
    }

    // 2. Handle the submission
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'category' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // 2MB max
            'is_emergency' => 'nullable|boolean'
        ]);

        // Handle the file upload (if a file was attached)
        $filePath = null;
        if ($request->hasFile('attachment')) {
            // This saves the file to storage/app/public/attachments
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        // Save to Database
        Grievance::create([
            'student_id' => Auth::id(), // Automatically grab the logged-in student's ID
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'attachment_path' => $filePath,
            'is_emergency' => $request->has('is_emergency'), // true if checked, false if not
            'status' => 'pending'
        ]);

        // Redirect back to dashboard with a success message
        return redirect()->route('student.dashboard')->with('success', 'Your grievance has been submitted successfully.');
    }
}