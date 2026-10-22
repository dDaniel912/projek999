<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function kartu()
    {
        $produkkartu = DB::table('branch_stok as bs')
            ->join('produk as p', 'p.id_produk', '=', 'bs.id_produk')
            ->join('branches as b', 'b.id_cabang', '=', 'bs.branch_id')
            ->select(
                'p.id_produk',
                'p.kode_produk',
                'p.barcode',
                'p.nama_produk',
                'b.nama_cabang',
                'bs.quantity',
                'bs.reserved_quantity',
                'bs.min_stok'
            )
            ->orderBy('p.nama_produk')
            ->get();

        return view('kartustok', compact('produkkartu'));
    }

    public function index(Request $request)
    {
        $branches = DB::table('branches')
            ->orderBy('nama_cabang')
            ->get();

        $branchId = $request->input('cabang')
            ?: optional($branches->first())->id_cabang;

        $search = $request->input('search');

        $stokQuery = DB::table('branch_stok as bs')
            ->join('branches as b', 'b.id_cabang', '=', 'bs.branch_id')
            ->join('produk as p', 'p.id_produk', '=', 'bs.id_produk')
            ->where('bs.branch_id', $branchId)
            ->select(
                'bs.id_stok',
                'bs.branch_id',
                'bs.id_produk',
                'bs.quantity',
                'bs.reserved_quantity',
                'bs.min_stok',
                'b.nama_cabang',
                'p.kode_produk',
                'p.barcode',
                'p.nama_produk',
                'p.unit',
                'p.cost_price',
                'p.selling_price'
            );

        if ($search) {
            $stokQuery->where(function ($query) use ($search) {
                $query->where('p.nama_produk', 'like', "%{$search}%")
                    ->orWhere('p.kode_produk', 'like', "%{$search}%")
                    ->orWhere('p.barcode', 'like', "%{$search}%");
            });
        }

        //mengirim ke kartu stok
        $stok = $stokQuery
            ->orderBy('p.nama_produk')
            ->get();

        $totalJenis = DB::table('branch_stok')
            ->where('branch_id', $branchId)
            ->count();

        $totalStok = DB::table('branch_stok')
            ->where('branch_id', $branchId)
            ->sum('quantity');

        $totalReserved = DB::table('branch_stok')
            ->where('branch_id', $branchId)
            ->sum('reserved_quantity');

        $stokMenipis = DB::table('branch_stok')
            ->where('branch_id', $branchId)
            ->whereRaw('quantity <= min_stok')
            ->count();

        $riwayat = collect();

        if ($branchId) {
            $riwayat = DB::table('mutasi as m')
                ->leftJoin(
                    'produk as p',
                    'p.barcode',
                    '=',
                    'm.barcode'
                )
                ->leftJoin(
                    'branches as ba',
                    'ba.id_cabang',
                    '=',
                    'm.asal_cabang'
                )
                ->leftJoin(
                    'branches as bt',
                    'bt.id_cabang',
                    '=',
                    'm.tujuan_cabang'
                )
                ->where(function ($query) use ($branchId) {
                    $query->where('m.asal_cabang', $branchId)
                        ->orWhere('m.tujuan_cabang', $branchId);
                })
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('p.nama_produk', 'like', "%{$search}%")
                            ->orWhere('p.kode_produk', 'like', "%{$search}%")
                            ->orWhere('m.barcode', 'like', "%{$search}%")
                            ->orWhere('m.nomor_mutasi', 'like', "%{$search}%");
                    });
                })
                ->select(
                    'm.id_mutasi',
                    'm.nomor_mutasi',
                    'm.barcode',
                    'm.jumlah',
                    'm.status',
                    'm.transfer_date',
                    'm.asal_cabang',
                    'm.tujuan_cabang',
                    'ba.nama_cabang as cabang_asal',
                    'bt.nama_cabang as cabang_tujuan',
                    'p.nama_produk',
                    'p.kode_produk'
                )
                ->orderByDesc('m.transfer_date')
                ->orderByDesc('m.id_mutasi')
                ->limit(100)
                ->get()
                ->map(function ($item) use ($branchId) {
                    $item->jenis = (string) $item->asal_cabang
                        === (string) $branchId
                        ? 'Keluar'
                        : 'Masuk';

                    return $item;
                });
        }

        return view('test.kartustok', compact(
            'branches',
            'branchId',
            'search',
            'stok',
            'totalJenis',
            'totalStok',
            'totalReserved',
            'stokMenipis',
            'riwayat'
        ));
    }
    // public function prokart()
    // {
    //     $produkkartu = DB::table('branch_stok as bs')
    //     ->join('produk as p', 'p.id_produk', '=', 'bs.id_produk')
    //     ->join('branches as b', 'b.id_cabang', '=', 'bs.branch_id')
    //     ->select(
    //         'p.id_produk',
    //         'p.kode_produk',
    //         'p.barcode',
    //         'p.nama_produk',
    //         'b.nama_cabang',
    //         'bs.quantity',
    //         'bs.reserved_quantity',
    //         'bs.min_stok'
    //     )
    //     ->orderBy('p.nama_produk')
    //     ->get();

    // return view('test.kartustok', compact('produkkartu'));
    // }
}
