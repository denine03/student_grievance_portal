<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\GrievanceStatusUpdated;
use App\Models\Grievance;

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
            'is_emergency' => 'nullable|boolean',
            'is_anonymous' => 'nullable|boolean'
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'local');
        }

        Grievance::create([
            'student_id' => Auth::id(),
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'attachment_path' => $filePath,
            'is_emergency' => $request->has('is_emergency'),
            'is_anonymous' => $request->has('is_anonymous'),
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

    public function downloadAttachment(Grievance $grievance)
    {
        $user = Auth::user();
        if ($user->role === 'student' && $grievance->student_id !== $user->id) {
            abort(403, 'Unauthorized access to private evidence.');
        }

        if (!$grievance->attachment_path || !Storage::disk('local')->exists($grievance->attachment_path)) {
            abort(404, 'Evidence file not found.');
        }

        return Storage::disk('local')->response($grievance->attachment_path);
    }

    public function addComment(Request $request, Grievance $grievance)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $grievance->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
}