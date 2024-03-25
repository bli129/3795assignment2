<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // Show a list of users
    public function index()
    {
        $users = AppUser::where('Role', 'user')->get(); // Assuming 'user' role for non-admins
        return view('userlist.index', compact('users'));
    }

    // Update the user status
    public function updateStatus(Request $request, $userId)
    {
        $user = AppUser::find($userId);
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->Status = $request->input('status'); // Assuming 'status' is passed as form data
        $user->save();

        return back()->with('success', "User status updated successfully.");
    }


}
