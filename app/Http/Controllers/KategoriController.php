<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        return view('test.pengaturan');
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'parent_id'      => 'nullable|string|max:100',
        ]);

        $kategori = DB::transaction(function () use ($data) {
            return Kategori::create($data);
        });

        return redirect()->route('pengaturan')
            ->with(
                'success',
                'Kategori berhasil ditambahkan dengan ID ' . $kategori->id_kategori
            );
    }
}
