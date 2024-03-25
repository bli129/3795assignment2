<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = AppUser::where('Email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            // Ensure the ID stored in the session matches your table's primary key naming
            Session::put('user', ['id' => $user->UserId, 'role' => $user->Role]);

            return $this->redirectBasedOnRole($user->Role);
        }

        return back()->withErrors(['login_error' => 'Invalid credentials. Please try again.']);
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/');
    }

    protected function redirectBasedOnRole($role)
    {
        return $role === 'admin' ? redirect('/userlist') : redirect('/transactions');
    }
}
