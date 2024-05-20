<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('AdminComponents.Layouts.layout');
    }

    public function login(Request $request)    {
        $username = $request->input('username');
        $password = $request->input('password');



        // Check if credentials are correct
        if ($username === 'admin' && $password === '1234') {

            $request->session()->put('admin-login', true);
            // Authentication successful, redirect to dashboard
            return redirect()->route('index')->withCookie(cookie('login', 'true', 60));
        } else {
            // Authentication failed, redirect back to login page with error message
            return redirect()->route('login')->with('error', 'Invalid username or password.');
        }
    }

    public function logout(Request $request){
    // Destroy the session
    $request->session()->invalidate();
    // Redirect to the login page
    return redirect()->route('index');
}
}
