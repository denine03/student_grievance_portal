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
        // 1. Validate the form data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'unique:users,student_id'],
            'school' => ['required', 'string'],
            'department' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        // 2. Create the User
        $user = User::create([
            'name' => $validated['name'],
            'student_id' => $validated['student_id'],
            'school' => $validated['school'],
            'department' => $validated['department'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student', // Force role to student for public registration
        ]);

        // 3. Log them in and redirect
        Auth::login($user);
        
        // We will create this dashboard view later
        return redirect()->route('home')->with('success', 'Registration successful!');
    }
}