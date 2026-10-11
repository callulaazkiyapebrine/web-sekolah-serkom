<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id_user', 'asc')->get();

        return view('admin.user.index', compact('users'));
    }

    public function addEdit($id = null)
    {
        $user = null;

        if ($id) {
            try {
                $userId = Crypt::decrypt($id);
            } catch (DecryptException $e) {
                abort(404);
            }

            $user = User::findOrFail($userId);
        }

        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => $id ? 'nullable|string|min:6' : 'required|string|min:6',
            'role' => 'required|in:admin,operator',
        ]);

        if ($id) {
            try {
                $userId = Crypt::decrypt($id);
            } catch (DecryptException $e) {
                abort(404);
            }

            $user = User::findOrFail($userId);
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
        try {
            $userId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($userId);

        return view('admin.user.show', compact('user'));
    }


    public function destroy($id)
    {
        try {
            $userId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($userId);

        // Admin utama tidak boleh dihapus
        if ($user->id_user == 1) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Admin utama tidak boleh dihapus.');
        }

        try {
            DB::transaction(function () use ($user) {

                // Jika user memiliki berita, pindahkan ke admin utama
                DB::table('berita')
                    ->where('id_user', $user->id_user)
                    ->update(['id_user' => 1]);

                // Hapus user
                $user->delete();
            });

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'Data user berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika masih terhubung dengan tabel lain
            if ($e->getCode() === '23000') {
                return redirect()
                    ->route('admin.user.index')
                    ->with(
                        'error',
                        'User tidak dapat dihapus karena masih terhubung dengan data lain.'
                    );
            }

            throw $e;
        }
    }
}
