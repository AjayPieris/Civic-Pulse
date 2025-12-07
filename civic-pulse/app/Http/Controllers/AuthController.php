<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash; // Import Hashing tool
use Illuminate\Support\Facades\Auth; // Import Auth tool

class AuthController extends Controller
{
    // 1. Show Register Form
    public function showRegister() {
        return view('auth.register');
    }

    // 2. Handle Registration
    public function register(Request $request) {
        // Validation
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Check if email already exists
            'password' => 'required|min:6|confirmed' // 'confirmed' checks password_confirmation field
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // NEVER save plain passwords!
        ]);

        // Auto-login the user after registration
        Auth::login($user);

        // Redirect to home
        return redirect('/issues')->with('success', 'Account created successfully!');
    }
}
