<?php

namespace App\Http\Controllers\Campus\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AuthCampusUserCredentialMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class AuthCampusController extends Controller
{
    /**
     * Display the verification form.
     */
    public function verification()
    {
        return Inertia::render('Campus/Auth/Verification');
    }

    /**
     * Display the send login credentials to campus user via email.
     */
    public function sendCredentials(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Mail::to($user->email)->send(new AuthCampusUserCredentialMail($user));
            return redirect()->route('verification')->with('success', 'Credentials sent successfully to your email!');
        }

        return redirect()->route('verification')->withErrors(['email' => 'No account found with the provided email or you are not part of the ZPPSU community.']);
    }

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Campus/Auth/Login');
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

        if (Auth::attempt($credentials) && Auth::user()->role_id == 2) {
            $request->session()->regenerate();

            return redirect()->route('home');
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
