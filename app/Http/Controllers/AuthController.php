<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Show Registration Page
    public function index()
    {
        return view('Auth.register');
    }

    // Handle Registration
    public function storeRegister(AuthRequest $authRequest)
    {
        DB::beginTransaction();
        try {
            $data = $authRequest->validated();
            $data['role'] = 'User';

            $user = User::create($data);
            Auth::login($user);

            DB::commit();

            return redirect()->route('index')->with(['message' => 'User Registered Successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // Show Login Page
    public function login()
    {
        return view('Auth.login');
    }

    // Handle Normal Login
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'Admin') {
                return redirect()->route('admin.user');
            }

            return redirect()->route('index');
        }

        return back()->with(['error' => 'Invalid login credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with(['message' => 'Logged out successfully']);
    }

    // Redirect to Google OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google OAuth Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'full_name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'role' => 'User',
                    'image' => $googleUser->avatar,
                ]
            );

            Auth::login($user);

            return redirect()->route('index')->with(['message' => 'Logged in successfully via Google']);
        } catch (\Exception $e) {
            return redirect()->route('admin.login')->with(['error' => 'Google login failed: ' . $e->getMessage()]);
        }
    }
}
