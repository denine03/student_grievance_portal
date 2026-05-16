<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grievance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalGrievances = Grievance::count();
        $pendingCount = Grievance::where('status', 'pending')->count();
        $resolvedCount = Grievance::whereIn('status', ['resolved', 'closed'])->count();
        $urgentCount = Grievance::where('is_emergency', true)->count();

        $recentGrievances = Grievance::with('student')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalGrievances', 'pendingCount', 'resolvedCount', 'urgentCount', 'recentGrievances'
        ));
    }

    public function index()
    {
        $users = User::latest()->paginate(15);
        $pageTitle = "Staff & Student Directory";
        
        return view('admin.users', compact('users', 'pageTitle'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:student,hod,dean,dsw_head,admin',
            'department' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return back()->with('success', "Account for {$user->name} has been successfully updated.");
    }
}