<?php

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Mutasi - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>body { font-family: system-ui, -apple-system, sans-serif; }</style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- HEADER -->
    <header class="h-16 bg-white border-b border-gray-200 px-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-[#1800AD]">Riwayat Mutasi</h1>
        <div class="flex items-center gap-3">
            <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                {{ strtoupper(substr(Auth::user()->name ?? 'Admin', 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- FILTER -->
    <form method="GET" action="{{ route('mutasi') }}" class="bg-white border-b border-gray-200 px-6 py-5">
        <div class="grid grid-cols-6 gap-4 items-end">
            <div>
                <label class="block text-xs text-gray-600 mb-1">Dari</label>
                <input type="date" name="dari" value="{{ $dari }}"
                    class="w-full border rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-xs text-gray-600 mb-1">Sampai</label>
                <input type="date" name="sampai" value="{{ $sampai }}"
                    class="w-full border rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-xs text-gray-600 mb-1">Asal</label>
                <select name="asal" class="w-full border rounded-xl px-4 py-3 text-sm bg-white">
                    <option value="">Semua</option>
                    @foreach ($cabang as $c)
                        <option value="{{ $c->id_cabang }}" @selected(request('asal') == $c->id_cabang)>{{ $c->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-600 mb-1">Tujuan</label>
                <select name="tujuan" class="w-full border rounded-xl px-4 py-3 text-sm bg-white">
                    <option value="">Semua</option>
                    @foreach ($cabang as $c)
                        <option value="{{ $c->id_cabang }}" @selected(request('tujuan') == $c->id_cabang)>{{ $c->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="py-3 rounded-xl bg-[#1800AD] text-white font-semibold hover:bg-indigo-800">
                Cari
            </button>
            {{-- formaction: tombol ini mengirim filter yang sama ke route export --}}
            <button type="submit" formaction="{{ route('mutasi.export') }}"
                class="py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </button>
        </div>

        @if ($errors->any())
            <p class="mt-3 text-sm text-red-600">{{ $errors->first() }}</p>
        @endif
    </form>

    <!-- TABEL -->
    <main class="p-8">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm">
                        <th class="px-6 py-4 font-semibold">No Mutasi</th>
                        <th class="px-6 py-4 font-semibold">Tanggal/Jam</th>
                        <th class="px-6 py-4 font-semibold">Asal</th>
                        <th class="px-6 py-4 font-semibold">Tujuan</th>
                        <th class="px-6 py-4 font-semibold text-right">Jumlah</th>
                        <th class="px-6 py-4 font-semibold text-right">Harga</th>
                        <th class="px-6 py-4 font-semibold text-center">#</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse ($mutasi as $m)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $m->nomor_mutasi ?? '-' }}</td>
                            <td class="px-6 py-4">{{ optional($m->transfer_date)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">{{ $m->asal->nama_cabang ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $m->tujuan->nama_cabang ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format($m->jumlah, 0, ',', '.') }}</td>
                            {{-- tabel mutasi belum punya kolom harga --}}
                            <td class="px-6 py-4 text-right">
                                {{ isset($m->harga) ? 'Rp ' . number_format($m->harga, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <button type="button" onclick="bukaDetail({{ $m->id_mutasi }})"
                                    class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                                <a href="{{ route('mutasi.cetak', $m->id_mutasi) }}" target="_blank"
                                    class="inline-block px-3 py-1.5 rounded-lg bg-gray-100 text-gray-700 text-xs font-semibold hover:bg-gray-200">
                                    <i class="fas fa-print mr-1"></i> Cetak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                Tidak ada data mutasi pada rentang yang dipilih
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $mutasi->links() }}</div>
    </main>

    <!-- MODAL DETAIL -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">Detail Mutasi</h2>
                    <p class="text-sm text-gray-500" id="detailSub"></p>
                </div>
                <button type="button" onclick="tutupDetail()" class="text-gray-500 hover:text-red-600 text-2xl">&times;</button>
            </div>
            <div id="detailBody" class="px-6 py-4 text-sm"></div>
            <div class="flex justify-end gap-3 px-6 py-4 border-t">
                <button type="button" onclick="tutupDetail()" class="px-5 py-2.5 rounded-xl border hover:bg-gray-100">Tutup</button>
                <a id="detailCetak" href="#" target="_blank"
                    class="px-5 py-2.5 rounded-xl bg-[#1800AD] text-white hover:bg-indigo-800">
                    <i class="fas fa-print mr-1"></i> Cetak
                </a>
            </div>
        </div>
    </div>

    <script>
        const URL_SHOW  = "{{ route('mutasi.show', ['mutasi' => '__ID__']) }}";
        const URL_CETAK = "{{ route('mutasi.cetak', ['mutasi' => '__ID__']) }}";
        const modalDetail = document.getElementById('modalDetail');

        async function bukaDetail(id) {
            const body = document.getElementById('detailBody');
            body.textContent = 'Memuat...';
            document.getElementById('detailSub').textContent = '';
            document.getElementById('detailCetak').href = URL_CETAK.replace('__ID__', id);
            modalDetail.classList.remove('hidden');
            modalDetail.classList.add('flex');

            try {
                const res = await fetch(URL_SHOW.replace('__ID__', id), { headers: { 'Accept': 'application/json' } });
                if (!res.ok) throw new Error();
                const d = await res.json();

                const rows = [
                    ['No Mutasi', d.nomor_mutasi], ['Barcode', d.barcode],
                    ['Tanggal/Jam', d.tanggal], ['Asal', d.asal], ['Tujuan', d.tujuan],
                    ['Jumlah', d.jumlah], ['Status', d.status],
                    ['Diminta oleh', d.diminta_oleh], ['Disetujui oleh', d.disetujui],
                    ['Dikirim', d.dikirim], ['Diterima', d.diterima],
                    ['Catatan', d.catatan], ['Dibuat', d.dibuat],
                ];

                body.textContent = '';
                rows.forEach(([label, value]) => {
                    const row = document.createElement('div');
                    row.className = 'flex justify-between gap-4 py-2 border-b last:border-0';
                    const l = document.createElement('span');
                    l.className = 'text-gray-500';
                    l.textContent = label;
                    const v = document.createElement('span');
                    v.className = 'font-medium text-right';
                    v.textContent = value;      // textContent: aman dari XSS
                    row.append(l, v);
                    body.appendChild(row);
                });
                document.getElementById('detailSub').textContent = d.barcode;
            } catch (e) {
                body.textContent = 'Gagal memuat detail mutasi.';
            }
        }

        function tutupDetail() {
            modalDetail.classList.remove('flex');
            modalDetail.classList.add('hidden');
        }

        modalDetail.addEventListener('click', e => { if (e.target === modalDetail) tutupDetail(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupDetail(); });
    </script>
</body>

</html>