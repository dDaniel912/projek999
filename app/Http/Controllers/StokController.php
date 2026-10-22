<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;

use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        return view('test.stok');
    }

    public function lama()
    {
        return view('test.stoklama');
    }

    public function laporstok()
    {
        return view('test.laporanstok');
    }

    public function opname()
    {
        return view('test.stokopname');
    }

    public function barcode()
    {
        return view('test.barcodesku');
    }

    public function detail($id_produk)
    {
        $produk = Produk::where('id_produk', $id_produk)
            ->firstOrFail();

        return view('test.insidekartustok', compact('produk'));
    }

    public function data()
    {
        $produks = Produk::all();

        return view('test.datastok', compact('produks'));
    }

    public function beli()
    {
        return view('test.pembelian');
    }
    public function export(Request $request)
    {
        $request->validate(['produk' => 'nullable|integer']);
        $rows = $this->query($request)->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM agar Excel membaca UTF-8
            fputcsv($out, ['No Faktur', 'Barcode', 'Supplier', 'Kode', 'Produk', 'Qty', 'Lokasi', 'Expired']);

            foreach ($rows as $s) {
                fputcsv($out, [
                    $s->no_faktur,
                    "\t" . $s->barcode,   // tab di depan: Excel tidak mengubah barcode jadi 1,23E+12
                    $s->supplier->nama_supplier ?? '-',
                    $s->produk->kode_produk ?? '-',
                    $s->produk->nama_produk ?? '-',
                    $s->qty,
                    $s->lokasi ?? '-',
                    optional($s->expired_date)->format('Y-m-d'),
                ]);
            }
            fclose($out);
        }, 'laporan-stok-' . now()->format('Ymd-His') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function query(Request $request)
    {
        return Stok::with(['produk', 'supplier'])
            ->when($request->filled('produk'), fn ($q) => $q->where('id_produk', $request->produk))
            ->orderBy('id_stok');
    }

    public function tampil(Request $request)
    {
        $request->validate(['produk' => 'nullable|integer']);

        $stok = $this->query($request)
            ->simplePaginate(10) 
            ->withQueryString();  

        $produk = Produk::orderBy('nama_produk')->get(['id_produk', 'kode_produk', 'nama_produk']);

        return view('test.laporanstok', compact('stok', 'produk'));
    }

}