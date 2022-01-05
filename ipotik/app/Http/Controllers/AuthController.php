<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->has('remember'))) {
            return redirect()->route('index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Login berhasil.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Akun tidak sesuai.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required|string',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->alamat = $validated['alamat'];
        $user->password = Hash::make($validated['password']);

        if ($user->save()) {
            return redirect()->route('login')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Pendaftaran berhasil.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Pendaftaran gagal.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
