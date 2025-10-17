<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    $path = $request->file('image')->store('user', 'public');
    
    User::create([
        'name' => $request-> name,
        'adress' => $request-> adress,
        'email' => $request-> email,
        'phonenumber' => $request-> phonenumber,    
        'password' => bcrypt($request-> password),
        'role' => $request-> role,
        'is_active' => $request-> is_active,
        'image' => $path,
        ]);



    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    // Show a single user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

}