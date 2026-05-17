<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Grievance;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalGrievances = Grievance::count();
        $pendingCount = Grievance::where('status', 'pending')->count();
        $resolvedCount = Grievance::whereIn('status', ['resolved', 'closed'])->count();
        $urgentCount = Grievance::where('is_emergency', true)->whereNotIn('status', ['resolved', 'closed'])->count();

        $query = Grievance::with('student')->latest();

        if ($request->filled('status')) {
            if ($request->status === 'urgent') {
                $query->where('is_emergency', true)->whereNotIn('status', ['resolved', 'closed']);
            } elseif ($request->status === 'resolved') {
                $query->whereIn('status', ['resolved', 'closed']);
            } else {
                $query->where('status', $request->status);
            }
        }
        $recentGrievances = $query->take(15)->get();

        $activeUserIds = DB::table('sessions')->whereNotNull('user_id')->distinct()->pluck('user_id')->toArray();

        $chartGrievances = [
            'pending' => $pendingCount,
            'in_progress' => Grievance::where('status', 'in_progress')->count(),
            'resolved' => Grievance::where('status', 'resolved')->count(),
            'closed' => Grievance::where('status', 'closed')->count(),
        ];

        $totalStudents = User::where('role', 'student')->count();
        $onlineStudents = User::where('role', 'student')->whereIn('id', $activeUserIds)->count();
        $chartStudents = [
            'total' => $totalStudents,
            'online' => $onlineStudents,
            'offline' => max(0, $totalStudents - $onlineStudents),
        ];

        $authRoles = ['hod', 'dean', 'dsw_head', 'admin'];
        $totalAuth = User::whereIn('role', $authRoles)->count();
        $onlineAuth = User::whereIn('role', $authRoles)->whereIn('id', $activeUserIds)->count();
        $chartAuthorities = [
            'total' => $totalAuth,
            'online' => $onlineAuth,
            'offline' => max(0, $totalAuth - $onlineAuth),
        ];

        if ($request->ajax()) {
            return view('admin.partials.dashboard-content', compact(
                'totalGrievances', 'pendingCount', 'resolvedCount', 'urgentCount', 'recentGrievances',
                'chartGrievances', 'chartStudents', 'chartAuthorities'
            ))->render();
        }

        return view('admin.dashboard', compact(
            'totalGrievances', 'pendingCount', 'resolvedCount', 'urgentCount', 'recentGrievances',
            'chartGrievances', 'chartStudents', 'chartAuthorities'
        ));
    }

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'students');
        $pageTitle = "Staff & Student Directory";

        if ($tab === 'authorities') {
            $users = User::where('role', '!=', 'student')->latest()->paginate(15);
        } else {
            $users = User::where('role', 'student')->latest()->paginate(15);
        }
        
        if ($request->ajax()) {
            return view('admin.partials.users-table', compact('users', 'tab'))->render();
        }
        
        return view('admin.users', compact('users', 'pageTitle', 'tab'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:student,hod,dean,dsw_head,admin',
            'department' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Account for {$user->name} has been successfully updated.",
                'user' => $user
            ]);
        }

        return back()->with('success', "Account for {$user->name} has been successfully updated.");
    }

    public function grievances(Request $request)
    {
        $query = Grievance::with(['student', 'comments.user'])->latest();

        $totalGrievances = Grievance::count();
        $pendingCount = Grievance::where('status', 'pending')->count();
        $resolvedCount = Grievance::whereIn('status', ['resolved', 'closed'])->count();
        $urgentCount = Grievance::where('is_emergency', true)->whereNotIn('status', ['resolved', 'closed'])->count();

        if ($request->filled('status')) {
            if ($request->status === 'urgent') {
                $query->where('is_emergency', true)->whereNotIn('status', ['resolved', 'closed']);
            } elseif ($request->status === 'resolved') {
                $query->whereIn('status', ['resolved', 'closed']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $grievances = $query->paginate(15);

        if ($request->ajax()) {
            return view('admin.partials.grievances-list', compact(
                'grievances', 'totalGrievances', 'pendingCount', 'resolvedCount', 'urgentCount'
            ))->render();
        }

        return view('admin.grievances', compact(
            'grievances', 'totalGrievances', 'pendingCount', 'resolvedCount', 'urgentCount'
        ));
    }

    public function updateGrievanceStatus(Request $request, Grievance $grievance)
    {
        $validated = $request->validate(['status' => 'required|in:pending,in_progress,resolved,closed']);
        $grievance->update(['status' => $validated['status']]);
        \App\Events\GrievanceStatusUpdated::dispatch($grievance);
        return back()->with('success', 'Grievance status updated successfully.');
    }

    public function deleteGrievance(Grievance $grievance)
    {
        if ($grievance->attachment_path) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($grievance->attachment_path);
        }
        $grievance->delete();
        return back()->with('success', 'Grievance permanently removed from the system.');
    }
}