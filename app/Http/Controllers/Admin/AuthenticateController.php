<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticateController extends Controller
{
    public function index() {
        return view('admin.admin');
    }
    public function login()
    {
//        dd(bcrypt('quocanh2000be'));
        if(Auth::check()) {
            return redirect()->route('home')->with('success', 'You have already logged in.');
        }
        return view('admin.adminLogin');
    }

    public function checkLogin(Request $request)
    {
        // Validate user input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user with or without "Remember Me" functionality
        $remember = $request->has('remember'); // Check if "Remember Me" checkbox is checked
        if (Auth::attempt($credentials, $remember)) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Logged in successfully.');
        } else {
            // Authentication failed
            return back()->with('error' , 'Invalid credentials'); // Redirect back with error message
        }
    }
    public function logout(Request $request)
    {
        // Perform custom logout logic
        Auth::logout();

        // Clear the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Clear all data from the session
        Session::flush();

        // Regenerate the session ID and token
        Session::regenerate();
        // Redirect to the desired page after logout
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
