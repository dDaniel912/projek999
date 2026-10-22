<?php

namespace App\Http\Controllers;

use app\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller 
{
    public function index() 
    {
        return view('test.pengaturan');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_petugas' => 'required|string|max:100',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|max:100|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,gudang,manager,spv,user',
        'is_active' => 'required|boolean',
    ]);

    DB::table('users')->insert([
        'nama_petugas' => $validated['nama_petugas'],
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'is_active' => $validated['is_active'],
    ]);

    return back()->with('success', 'Akun berhasil ditambahkan.');
}
    public function tampil()
        {
            // 1. Ambil semua data petugas menggunakan Eloquent
            $daftar_petugas = Petugas::all();

            // 2. Kirim data ke halaman view (petugas.blade.php)
            return view('test.pengaturan', compact('daftar_petugas'));
        }
}