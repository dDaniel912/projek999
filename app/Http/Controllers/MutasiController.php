<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutasiController extends Controller
{
            public function index()
        {
            return view('test.mutasi');
        }

        public function tampil(Request $request)
    {
        [$dari, $sampai] = $this->validasiFilter($request);

        $mutasi = $this->query($request, $dari, $sampai)
            ->paginate(15)
            ->withQueryString();

        $cabang = Cabang::orderBy('kode_cabang')->get(['id_cabang', 'kode_cabang', 'nama_cabang']);

        return view('test.riwayatmutasi', compact('mutasi', 'cabang', 'dari', 'sampai'));
    }

    public function export(Request $request)
    {
        [$dari, $sampai] = $this->validasiFilter($request);
        $rows = $this->query($request, $dari, $sampai)->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM agar Excel membaca UTF-8
            fputcsv($out, ['No Mutasi', 'Tanggal/Jam', 'Asal', 'Tujuan', 'Barcode', 'Jumlah', 'Status', 'Catatan']);

            foreach ($rows as $m) {
                fputcsv($out, [
                    $m->nomor_mutasi ?? '-',
                    optional($m->transfer_date)->format('d/m/Y H:i'),
                    $m->asal->nama_cabang ?? '-',
                    $m->tujuan->nama_cabang ?? '-',
                    $m->barcode,
                    $m->jumlah,
                    $m->status ?? '-',
                    $m->notes,
                ]);
            }
            fclose($out);
        }, 'riwayat-mutasi-' . now()->format('Ymd-His') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /* ---------- helper ---------- */

    private function validasiFilter(Request $request): array
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
            'asal'   => 'nullable|integer',
            'tujuan' => 'nullable|integer',
        ]);

        return [
            $request->input('dari', now()->subDays(7)->toDateString()),
            $request->input('sampai', now()->toDateString()),
        ];
    }

    private function query(Request $request, string $dari, string $sampai)
    {
        return Mutasi::with(['asal', 'tujuan'])
            ->whereDate('transfer_date', '>=', $dari)
            ->whereDate('transfer_date', '<=', $sampai)
            ->when($request->filled('asal'), fn ($q) => $q->where('asal_cabang', $request->asal))
            ->when($request->filled('tujuan'), fn ($q) => $q->where('tujuan_cabang', $request->tujuan))
            ->orderByDesc('transfer_date');
    }

            public function riwayat()
        {
            return view('test.riwayatmutasi');
        }

        public function detailmutasi()
        {
            return view('test.detailriwayatmutasi');
        }

        public function tambahmutasi()
        {
            return view('test.tambahmutasi');
        }

        public function store(Request $request)
        {
        $data = $request->validate([
            'asal_cabang' => 'required|string|max:100',
            'tujuan_cabang' => 'required|string|max:100|different:asal_cabang_id',
            'approved_by'=> 'required|string|max:50',
            'notes'=> 'string|max:100',
            'jumlah' => 'required|integer|max:25',
            'barcode'=> 'required|string|max:100',
        ]);

        $mutasi = DB::transaction(function () use ($data) {
            return Mutasi::create($data);
        });

        return redirect()->route('tambahmutasi')
            ->with(
                'success',
                'Proses mutasi berhasil dilakukan dengan ID ' . $mutasi->id_mutasi
            );
        }
}