<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grievance;
use App\Events\GrievanceStatusUpdated;
use App\Events\CommentPosted;

class AuthorityController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        $query = Grievance::with(['student', 'comments.user'])->latest();

        if ($user->role === 'hod') {
            $query->where('category', '!=', 'Hostel')
                  ->whereHas('student', function ($q) use ($user) {
                      $q->where('department', $user->department);
                  });
        } elseif ($user->role === 'dean') {
            $query->where('category', '!=', 'Hostel')
                  ->whereHas('student', function ($q) use ($user) {
                      $q->where('school', $user->school);
                  });
        } elseif ($user->role === 'dsw_head') {
            $query->whereIn('category', ['Hostel', 'Harassment', 'Infrastructure']);
        }

        $pendingCount = (clone $query)->where('status', 'pending')->count();
        $inProgressCount = (clone $query)->where('status', 'in_progress')->count();
        $resolvedCount = (clone $query)->whereIn('status', ['resolved', 'closed'])->count();

        if ($request->filled('status')) {
            if ($request->status === 'resolved') {
                $query->whereIn('status', ['resolved', 'closed']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $grievances = $query->get(); 

        if ($request->ajax()) {
            return view('authority.partials.dashboard-content', compact(
                'grievances', 'pendingCount', 'inProgressCount', 'resolvedCount'
            ))->render();
        }

        return view('authority.dashboard', compact(
            'grievances', 'pendingCount', 'inProgressCount', 'resolvedCount'
        ));
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

    public function addComment(Request $request, Grievance $grievance)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $comment = $grievance->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);

        \App\Events\CommentPosted::dispatch($comment);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'comment' => $comment->load('user')
            ]);
        }

        return back()->with('success', 'Message sent successfully.');
    }
}
