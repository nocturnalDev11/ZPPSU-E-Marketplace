<?php

namespace App\Http\Controllers\External\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthExternalController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('External/Auth/Login');
    }

    /**
     * Display the signup view.
     */
    public function signupForm(): Response
    {
        return Inertia::render('External/Auth/Signup');
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function signup(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $validatedData['role_id'] = $validatedData['role_id'] ?? 3;

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        Auth::login($user);
        // Redirect to a route, or return an Inertia response
        return redirect()->route('external.home');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials) && Auth::user()->role_id == 3) {
            $request->session()->regenerate();

            return redirect()->route('external.home');
        } else {
            return back()->withErrors(['error' => 'Invalid credentials or unauthorized access']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
