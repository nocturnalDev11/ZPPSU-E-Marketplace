<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Mail\AuthUserCredential;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    /**
     * Display the verification form.
     */
    public function verification()
    {
        return Inertia::render('User/Auth/Verification');
    }

    /**
     * Display the send login credentials to campus user via email.
     */
    public function sendCredentials(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Mail::to($user->email)->send(new AuthUserCredential($user));
            return redirect()->route('verification')->with('success', 'Credentials sent successfully to your email!');
        }

        return redirect()->route('verification')->withErrors(['email' => 'No account found with the provided email or you are not part of the ZPPSU community.']);
    }
}
