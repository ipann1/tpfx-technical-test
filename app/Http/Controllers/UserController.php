<?php

namespace App\Models\User;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // pastikan model User diimport
use Illuminate\Support\Facades\Hash; // untuk hashing password

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(10); // ambil semua data user
        $title = 'Users';
        return view('users', compact('users', 'title')); // kirim ke view
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users')->with('success', 'User created successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string', // tambahkan validasi password opsional
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // hash password
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
