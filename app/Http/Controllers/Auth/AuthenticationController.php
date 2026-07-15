<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['bail', 'required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::validate($credentials)) {
            return back()->withInput()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user->status !== Status::ACTIVE) {
            return back()->withInput()->withErrors([
                'email' => 'Your account is currently inactive. Please contact support.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
