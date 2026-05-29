<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) return redirect('/admin');
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'minieh2026');

        if ($request->username === $username && $request->password === $password) {
            session(['admin_logged_in' => true]);
            return redirect('/admin');
        }

        return back()->with('error', 'Invalid credentials.');
    }
}