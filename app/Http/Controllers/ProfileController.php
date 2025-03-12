<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('layouts.profile', [
            'title'  => 'Profile',
            'active' => 'profile',
            'user'   => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:3|max:11|unique:users,username,' . $user->id,
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'phone'    => 'required|string|max:15|unique:users,phone,' . $user->id,
            'image'    => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->password) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        if ($request->file('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            // Buat nama unik berdasarkan timestamp
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

            // Pindahkan file ke storage/app/public/profile/
            $request->file('image')->move(storage_path('app/public/profile'), $imageName);

            // Simpan path yang bisa diakses dari public/storage/
            $validatedData['image'] = "storage/profile/$imageName";
        }

        $user->update($validatedData);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.profile')->with('success', 'User updated successfully!');
        } else {
            return redirect()->route('user.profile')->with('success', 'User updated successfully!');
        }
    }
}
