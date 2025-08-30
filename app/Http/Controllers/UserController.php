<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $dokters = User::where('email', '!=', 'admin1@gmail.com')
            ->latest()
            ->paginate(10);
        return view('dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = User::findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $dokter = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $dokter->id],
            'password' => ['nullable', 'min:6'],
        ]);

        $dokter->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $dokter->password,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = User::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
