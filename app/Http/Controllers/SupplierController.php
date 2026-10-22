<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller 
{
    public function index() 
    {
        return view('test.pengaturan');
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'nama_supplier' => 'required|string|max:100',
        'phone'         => 'nullable|string|max:20',
        'alamat'        => 'nullable|string',
    ]);

    $supplier = DB::transaction(function () use ($data) {
                return Supplier::create($data);
            });

    return redirect()->route('pengaturan')
            ->with(
                'success',
                'Supplier berhasil ditambahkan dengan ID ' . $supplier->id_supplier
            );
    }
}