<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
                  ->orWhere('phonenumber', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('id', 'desc')->paginate(5);

        return view('pages.maindata.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.maindata.user.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'adress' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phonenumber' => 'required|string|max:20|unique:users,phonenumber',
                'password' => 'required|string|min:6',
                'role' => 'required|in:admin,technician,customer',
                'is_active' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpg,jpeg,png',
            ]);

            $path = $request->hasFile('image')
                ? $request->file('image')->store('user', 'public')
                : null;

            User::create([
                'name' => $request->name,
                'adress' => $request->adress,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'is_active' => $request->is_active,
                'image' => $path,
            ]);

            return redirect()->route('users.index')->with('success', '✅ User berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat user: '.$e->getMessage());
            return redirect()->back()->with('error', '❌ Gagal membuat user.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.maindata.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
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

            if ($request->hasFile('image')) {
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
                $path = $request->file('image')->store('user', 'public');
                $user->image = $path;
            }

            $user->update([
                'name' => $request->name,
                'adress' => $request->adress,
                'phonenumber' => $request->phonenumber,
                'email' => $request->email,
                'role' => $request->role,
                'is_active' => $request->is_active,
                'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            ]);

            return redirect()->route('users.index')->with('success', '✅ User berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate user: '.$e->getMessage());
            return redirect()->back()->with('error', '❌ Gagal mengupdate user.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $user->delete();

            return redirect()->route('users.index')->with('success', '🗑️ User berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus user: '.$e->getMessage());
            return redirect()->back()->with('error', '❌ Gagal menghapus user.');
        }
    }

    public function toggleStatus($id)
    {
        Log::info('toggleStatus dipanggil untuk user ID: ' . $id);

        $user = User::findOrFail($id);
        $user->is_active = $user->is_active === 'active' ? 'inactive' : 'active';
        $user->save();

        return response()->json([
            'status' => 'success',
            'is_active' => $user->is_active,
            'color' => $user->is_active === 'active' ? 'text-success' : 'text-danger',
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.maindata.user.detail', compact('user'));
    }

}
