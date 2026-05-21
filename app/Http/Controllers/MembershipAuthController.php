<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MembershipAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:memberships,email',
            'birth_date' => 'required|date',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $member = Membership::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'city' => $request->city,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('member')->login($member, $request->has('remember'));

        return redirect()->route('frontend.membership')->with('success', 'Registration successful. Welcome to the family!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');

        if (Auth::guard('member')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('frontend.membership')->with('success', 'You are now logged in!');
        }

        return back()->with('error', 'The provided credentials do not match our records.')->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.membership')->with('success', 'You have been logged out.');
    }
}
