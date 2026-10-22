<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::all();
        $kategori = Kategori::all();

        $query = Produk::query();

    if ($request->filled('kategori')) {
        $query->where(
            'id_kategori',
            $request->kategori
        );
    }

    $produks = $query->get();

    return view('test.datastok', compact(
        'produks',
        'kategori'
    ));
    }

    public function kartu()
    {
        $produkkartu = Produk::all();

        return view('test.kartustok', compact('produkkartu'));
    }

    public function create()
    {
        return view('test.pengaturan');
    }

    public function store(Request $request)
    {
        $Validated = $request->validate([
            'id_produk' => 'required|max:50',
            'kode_produk' => 'required|string|max:50',
            'barcode' => 'required|max:100',
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|integer',
            'merk_produk' => 'required|string|max:100',
            'unit' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        Produk::create($Validated);

        return redirect()
            ->route('pengaturan')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(string $barcode)
    {
        $produk = Produk::findOrFail($barcode);

        return view('produk.show', compact('produk'));
    }

    public function edit(string $barcode)
    {
        $produk = Produk::findOrFail($barcode);

        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, string $barcode)
    {
        $produk = Produk::findOrFail($barcode);

        $request->validate([
            'barcode' => $request->barcode,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
        ]);

        $produk->update([
            'barcode' => $request->barcode,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()
            ->route('produk.update')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $barcode)
    {
        $produk = Produk::findOrFail($barcode);

        $produk->delete();

        return redirect()
            ->route('produk.destroy')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function statistik()
    {
        $jumlahBarang = Produk::sum('unit');

        $barangMasuk = DB::table('stock_movements')
            ->where('tipe', 'masuk')
            ->sum('quantity_change');

        $barangKeluar = DB::table('stock_movements')
            ->where('tipe', 'keluar')
            ->sum('quantity_change');

        return response()->json([
            'jumlah_barang' => $jumlahBarang,
            'barang_masuk' => $barangMasuk,
            'barang_keluar' => $barangKeluar,
        ]);
    }

    public function pengaturan()
    {
        return view('test.pengaturan');
    }

    public function search(Request $request)
    {
        $keyword = trim($request->query('q', ''));

        if (mb_strlen($keyword) < 2) {
            return response()->json([]);
        }

        $produk = DB::table('produk')
            ->select('kode_produk', 'nama_produk')
            ->where('nama_produk', 'like', '%'.$keyword.'%')
            ->orderBy('nama_produk')
            ->limit(10)
            ->get();

        return response()->json($produk);

        $kategori = Produk::query()
            ->whereNotNull('kategori')
            ->where('kategori', '<>', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        // Ambil data produk
        $query = Produk::query();

        // Filter berdasarkan kategori yang dipilih
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $produk = $query->orderBy('id_produk')->get();

        return view('test.datastok', compact(
            'produk',
            'kategori'
        ));
    }
}