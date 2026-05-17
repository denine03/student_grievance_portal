<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
        
        return redirect()->route('student.dashboard')->with('success', 'Registration successful!');
    }

    public function registerStaffSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role' => ['required', 'in:hod,dean,dsw_head'], 
            'school' => ['required_if:role,hod,dean', 'nullable', 'string'], 
            'department' => ['required_if:role,hod', 'nullable', 'string'],
        ]);

        if ($validated['role'] === 'hod') {
            if (User::where('role', 'hod')->where('department', $validated['department'])->exists()) {
                return back()->withErrors(['role' => "An HOD is already registered for {$validated['department']}."])->withInput();
            }
        } 
        elseif ($validated['role'] === 'dean') {
            if (User::where('role', 'dean')->where('school', $validated['school'])->exists()) {
                return back()->withErrors(['role' => "A Dean is already registered for {$validated['school']}."])->withInput();
            }
        } 
        elseif ($validated['role'] === 'dsw_head') {
            if (User::where('role', 'dsw_head')->exists()) {
                return back()->withErrors(['role' => "The Directorate of Student Welfare (DSW) Head position is already filled."])->withInput();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'student_id' => null, 
            'school' => $validated['school'] ?? null,
            'department' => $validated['department'] ?? null, 
        ]);

        Auth::login($user);
        
        return redirect()->route('authority.dashboard')->with('success', 'Staff account created successfully!');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            if (Auth::user()->isStudent()) {
                return redirect()->route('student.dashboard');
            } 
            elseif (Auth::user()->isFaculty()) {
                return redirect()->route('authority.dashboard'); 
            } 
            elseif (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard'); 
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}