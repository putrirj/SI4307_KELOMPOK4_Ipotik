<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'same:password',
            'photo' => 'file|image|mimes:jpg,jpeg,png'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $validated['name'];
        $user->alamat = $validated['alamat'];

        if ($request->has('password') && $validated['password'] != null) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->has('photo') && $validated['photo'] != null) {
            $user->photo = $validated['photo']->store('avatars', 'public');
        }

        if ($user->save()) {
            return back()
                ->with('alert_type', 'success')
                ->with('alert_message', 'Profile berhasil diupdate.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Profile gagal diupdate.');
    }
}
