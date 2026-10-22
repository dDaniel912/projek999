<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller 
{
    public function index() 
    {
        return view('test.pengaturan');
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'nama_customer' => 'required|string|max:100',
        'phone'         => 'nullable|string|max:20',
        'alamat'        => 'nullable|string',
    ]);

    $customers = DB::transaction(function () use ($data) {
                return Customer::create($data);
            });

    return redirect()->route('pengaturan')
            ->with(
                'success',
                'Customer berhasil ditambahkan dengan ID ' . $customers->id_customer
            );
    }
}