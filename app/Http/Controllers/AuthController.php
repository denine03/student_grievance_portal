<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- 1. REGISTRATION METHOD (You already have this) ---
    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'unique:users,student_id'],
            'school' => ['required', 'string'],
            'department' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'student_id' => $validated['student_id'],
            'school' => $validated['school'],
            'department' => $validated['department'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student', 
        ]);

        Auth::login($user);
        
        // Redirecting to the student dashboard after registration
        return redirect()->route('student.dashboard')->with('success', 'Registration successful!');
    }

    // --- 2. LOGIN METHOD (Add this!) ---
    public function loginSubmit(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role (using the helper method we added to the User model!)
            if (Auth::user()->isStudent()) {
                return redirect()->route('student.dashboard');
            }

            // Fallback for admins/faculty (we will build their dashboards later)
            return redirect('/');
        }

        // If authentication fails, send them back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // --- 3. LOGOUT METHOD (Add this!) ---
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}