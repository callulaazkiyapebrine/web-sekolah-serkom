<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest('id')->get();

        return view('admin.user.index', compact('users'));
    }

    public function addEdit($id = null)
    {
        $user = null;

        if ($id) {
            $user = User::findOrFail(Crypt::decrypt($id));
        }

        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'username' => 'required',
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required|in:admin,operator',
        ]);

        if ($id) {
            $user = User::findOrFail(Crypt::decrypt($id));
        } else {
            $user = new User();
        }

        $user->username = $request->username;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with(
                'success',
                $id
                    ? 'Data user berhasil diperbarui.'
                    : 'Data user berhasil ditambahkan.'
            );
    }

    public function show($id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        // Admin utama tidak boleh dihapus
        if ($user->id == 1) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Admin utama tidak boleh dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
}