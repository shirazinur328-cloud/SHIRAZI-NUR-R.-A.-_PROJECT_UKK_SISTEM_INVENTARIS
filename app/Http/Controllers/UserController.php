<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_data(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(7)
            ->withQueryString();

            return view('pages.users.index', [
                'title' => 'Manajemen Pengguna',
                'users' => $users,
            ]);
    }

    public function user_detail(User $user)
    {
        return view('pages.users.detail', [
            'title' => 'Detail Pengguna',
            'user' => $user,
        ]);
    }

    public function user_add(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            User::create($validated);

            return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
        }

        return view('pages.users.form', [
            'title' => 'Tambah Pengguna',
            'user' => null,
        ]);
    }

    public function user_edit(Request $request, User $user)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email,' . $user->id],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);

            if (empty($validated['password'])) {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
        }

        return view('pages.users.form', [
            'title' => 'Edit Pengguna',
            'user' => $user,
        ]);
    }

    public function user_delete(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Akun yang sedang login tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }    
}
