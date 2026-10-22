<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function index()
    {
        return view('test.pengaturan');
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'kode_cabang' => 'required|string|max:20|unique:branches,kode_cabang',
    //         'nama_cabang' => 'required|max:100',
    //         'alamat'      => 'nullable|string',
    //         'phone'       => 'nullable|max:20',
    //         'email'       => 'nullable|email|max:100',
    //         'is_active'   => 'required|in:0,1',
    //     ]);

    //     $branches = DB::transaction(function () use ($data) {
    //         return Cabang::create($data);
    //     });

    //     return redirect()->route('pengaturan')
    //         ->with('success', 'Cabang berhasil ditambahkan dengan ID ');
    // }

     public function store(Request $request)
    {
        $data = $request->validate([
            'kode_cabang' => 'required|string|max:20|unique:branches,kode_cabang',
            'nama_cabang' => 'required|string|max:100',
            'alamat'      => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
            'is_active'   => 'required|in:0,1',
        ]);

        $cabang = DB::transaction(function () use ($data) {
            return Cabang::create($data);
        });

        return redirect()->route('pengaturan')
            ->with(
                'success',
                'Cabang berhasil ditambahkan dengan ID ' . $cabang->id_cabang
            );
    }
}
