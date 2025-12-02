<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view("account.auth.register");
    }

    // Process registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.showRegister')->withInput()->withErrors($validator);
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('account.showLogin')->with('success', 'Register Successfully!');
    }

    // Show login form
    public function showLogin()
    {
        return view('account.auth.login');
    }

    // Process login
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.showLogin')->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.showProfile');
        } else {
            return redirect()->route('account.showLogin')->with('error', 'Either Email or Password is Incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.showLogin');
    }
}
