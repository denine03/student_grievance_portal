<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\GrievanceStatusUpdated;

class GrievanceController extends Controller
{
    public function create()
    {
        return view('student.create-grievance');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'is_emergency' => 'nullable|boolean'
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        $grievance = Grievance::create([
            'student_id' => Auth::id(),
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'attachment_path' => $filePath,
            'is_emergency' => $request->has('is_emergency'),
            'status' => 'pending'
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Your grievance has been submitted successfully.');
    }

    public function updateStatus(Request $request, Grievance $grievance)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed'
        ]);

        $grievance->update(['status' => $validated['status']]);
        
        GrievanceStatusUpdated::dispatch($grievance);

        return back()->with('success', 'Grievance status updated to ' . str_replace('_', ' ', $validated['status']));
    }
}