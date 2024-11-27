<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();

        return Inertia::render('Admin/Users/UserManagement', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'gender' => 'nullable|string',
            'home_address' => 'nullable|string|max:255',
            'login_id' => 'nullable|string',
            'role_id' => 'nullable|exists:roles,id',
            'department' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['role_id'] = $validated['role_id'] ?? 2;

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'home_address' => $validated['home_address'],
            'login_id' => $validated['login_id'],
            'role_id' => $validated['role_id'],
            'department' => $validated['department'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('all.users')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource in edit user details.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return Inertia::render('Admin/Users/EditUsers', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'home_address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('all.users')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('all.users')->with('success', 'User deleted successfully.');
    }
}
