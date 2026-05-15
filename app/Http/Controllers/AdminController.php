<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('id', '!=', Auth::id())->latest();

        $filter = $request->query('filter');
        
        if ($filter === 'students') {
            $query->where('role', 'student');
            $pageTitle = 'Student Directory';
        } elseif ($filter === 'staff') {
            $query->whereIn('role', ['hod', 'dean', 'dsw_head']);
            $pageTitle = 'Staff & Authorities';
        } else {
            $pageTitle = 'All System Users';
        }

        $users = $query->paginate(10)->appends($request->query());

        return view('admin.users', compact('users', 'pageTitle', 'filter'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:student,hod,dean,dsw_head,admin',
            'department' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:255',
        ]);

        $user->update([
            'role' => $validated['role'],
            'department' => $validated['department'],
            'school' => $validated['school'],
        ]);

        return back()->with('success', "Account for {$user->name} has been successfully updated.");
    }
}