<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.user', compact('users'));
    }

    public function accept($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1; // diterima
        $user->save();

        return back()->with('success', 'User berhasil diterima!');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 2; // ditolak
        $user->save();

        return back()->with('success', 'User berhasil ditolak!');
    }
}
