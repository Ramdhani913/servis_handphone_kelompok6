<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all();
        return view('pages.maindata.user.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        return view('pages.maindata.user.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phonenumber' => 'required|string|max:20|unique:users,phonenumber',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,technician,customer',
            'is_active' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Jalankan hanya kalau ada file gambar
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('user', 'public');
        }

        User::create([
            'name' => $request->name,
            'adress' => $request->adress,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,    
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => $request->is_active,
            'image' => $path, // bisa null kalau tidak ada foto
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show a single user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.maindata.user.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.maindata.user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phonenumber' => 'required|string|max:20|unique:users,phonenumber,'.$user->id,
            'role' => 'required|in:admin,technician,customer',
            'is_active' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6',
        ]);

        // ✅ Jalankan hanya kalau ada file baru
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('image')->store('user', 'public');
            $user->image = $path;
        }

        // Update data lainnya
        $user->update([
            'name' => $request->name,
            'adress' => $request->adress,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->is_active,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
