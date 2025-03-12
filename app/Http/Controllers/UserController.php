<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5);

        return view('user-managements.index', [
            'title'  => 'Users Managements',
            'active' => 'users-managements',
            'users'  => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-managements.create', [
            'title'  => 'Create User',
            'active' => 'users-managements',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:3|max:11|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|string|in:admin,user',
            'phone'    => 'required|string|max:15|unique:users,phone',
            'image'    => 'required|image|file|max:2048|mimes:png,jpg,jpeg',
        ]);

        // Hash password sebelum disimpan
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Simpan file jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Buat nama unik berdasarkan timestamp
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Pindahkan file ke storage/app/public/profile/
            $image->move(storage_path('app/public/profile'), $imageName);

            // Simpan path yang bisa diakses dari public/storage/
            $validatedData['image'] = "storage/profile/$imageName";
        }

        // Simpan user ke database
        User::create($validatedData);

        return redirect()->route('users.managements.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user-managements.edit', [
            'title'  => 'Edit User',
            'active' => 'users-managements',
            'user'   => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:3|max:11|unique:users,username,' . $user->id,
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'role'     => 'required|string|in:admin,user',
            'phone'    => 'required|string|max:15|unique:users,phone,' . $user->id,
            'image'    => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->password) {
            $validatedData['password'] = bcrypt($validatedData['password']);
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

        return redirect()->route('users.managements.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.managements.index')->with('success', 'User deleted successfully!');
    }
}
