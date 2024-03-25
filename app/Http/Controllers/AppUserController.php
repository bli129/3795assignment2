<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    public function index()
    {
        // Load the registration view
        return view('registration.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,Email', // Reference the correct table
            'password' => 'required|min:3',
        ]);

        AppUser::create([
            'Email' => $validatedData['email'],
            'Password' => $validatedData['password'], // Password is hashed automatically
            'Role' => 'user', // Assuming a default role
            'Status' => 0, // Start as inactive (0)
        ]);

        return redirect()->route('registration.index')->with('success', 'Registration successful. Please wait for admin approval.');
    }
}
