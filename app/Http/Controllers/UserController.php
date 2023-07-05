<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {

        return view('index');
    }

    public function register(Request $request) {

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect()->back()->with('success', 'User registration successful.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. User registration failed.');
        }

    }

    public function login(Request $request) {

        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($validatedData)) {
                return redirect()->intended('/0/dashboard')->with('success', 'Login successful. Welcome back!');
            } else {
                return redirect()->back()->with('error', 'Incorrect credentials. Please try again.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Incorrect credentials. Please try again.');
        }
    }

    public function logout() {

        Auth::logout();
        return redirect('/')->with('success', 'Logout successful.');
    }
}
