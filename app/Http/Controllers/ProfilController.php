<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfilController extends Controller
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'nama_petugas',
        'email',
        'password',
        'role',
    ];
    public function profile() {
        // Mengambil data user yang sedang login
        $user = auth()->user(); 
    
    // Pastikan variabel $user dimasukkan ke dalam compact()
    return view('test.profil', compact('user')); 
    }
    
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_petugas' => 'required|string|max:100',
        'username'     => 'required|string|max:50|unique:users,username',
        'email'        => 'required|email|max:100|unique:users,email',
        'password'     => 'required|string|min:8',
        'role'         => 'required|in:admin,gudang,manager,spv,user',
        'is_active'    => 'required|boolean',
    ]);

    DB::table('users')->insert([
        'nama_petugas' => $validated['nama_petugas'],
        'username'     => $validated['username'],
        'email'        => $validated['email'],
        'password'     => Hash::make($validated['password']),
        'role'         => $validated['role'],
        'is_active'    => $validated['is_active'],
    ]);

    return back()->with(
        'success',
        'Berhasil ditambahkan.'
    );
}


}