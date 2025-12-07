<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;                  // User model for saving users
use Illuminate\Support\Facades\Hash;  // Hash passwords securely
use Illuminate\Support\Facades\Auth;  // Login/Logout tools

class AuthController extends Controller
{
    // 1. Show Register Form
    public function showRegister() {
        return view('auth.register');  // Show the register page
    }

    // 2. Handle Registration
    public function register(Request $request) {

        // Validate incoming data -------------------------
        $request->validate([
            'name' => 'required|min:3',                      // Must have name with at least 3 characters
            'email' => 'required|email|unique:users,email',  // Must be email and NOT already used
            'password' => 'required|min:6|confirmed'         // confirmed means it must match password_confirmation
        ]);

        // Create a new user in the database ---------------
        $user = User::create([
            'name' => $request->name,                         // Save name
            'email' => $request->email,                       // Save email
            'password' => Hash::make($request->password)      // Hash password (never save plain text)
        ]);

        // Log the user in automatically -------------------
        Auth::login($user);

        // Redirect user to /issues page -------------------
        return redirect('/')->with('success', 'Account created successfully!');
    }


    // 3. Show Login Form
    public function showLogin() {
        return view('auth.login');   // Show the login page
    }

    // 4. Handle Login Attempt
    public function login(Request $request) {

        // Validate login input ----------------------------
        $credentials = $request->validate([
            'email' => ['required', 'email'],       // Email must be valid
            'password' => ['required'],             // Password must not be empty
        ]);

        // Try to log the user in --------------------------
        if (Auth::attempt($credentials)) {          // Does email + password match?
            
            $request->session()->regenerate();      // Prevent session fixation (security)

            // Redirect to intended page or /issues -------
            return redirect()->intended('/')
                   ->with('success', 'Welcome back!');
        }

        // If login fails ----------------------------------
        return back()
            ->withInput()                           // Keep email typed in the form
            ->with('status', 'The provided credentials do not match our records.');
    }


    // 5. Handle Logout
    public function logout(Request $request) {

        Auth::logout();                              // Log user out

        $request->session()->invalidate();           // Destroy old session
        $request->session()->regenerateToken();      // Create a new CSRF token

        return redirect('/')                   // Redirect user
               ->with('status', 'You have been logged out.');
    }
}
