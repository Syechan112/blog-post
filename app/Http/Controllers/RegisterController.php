<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title'  => 'Register',
            'active' => 'register',
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:3|max:11|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|string|in:admin,user',
            'phone'    => 'required|string|max:15|unique:users,phone',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('login.index');
    }
}
