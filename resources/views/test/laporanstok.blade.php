<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Lama - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laporanstok.css')}}">
</head>

<body class="tail-container bg-zinc-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <div class="sidebar-bg w-72 flex flex-col text-white shadow-2xl">
            <!-- Logo -->
            <div class="px-8 pt-8 pb-6 logo-container">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-white rounded-2xl flex items-center justify-center shadow-inner">
                        <span class="text-3xl font-bold text-[#1800AD]">E</span>
                    </div>
                    <div>
                        <span class="logo-font text-3xl font-bold tracking-tighter">ElectricBlue</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-2 overflow-y-auto">
                <ul class="space-y-1">
                    @php        
                                                    $menus = [
                            [
                                'name' => 'Dashboard',
                                'path' => route('dashboard'),
                                'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1',
                            ],

                            [
                                'name' => 'Penjualan',
                                'path' => route('penjualan'),
                                'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            ],

                            [
                                'name' => 'Persediaan Stok',
                                'path' => route('persediaan'),
                                'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                            ],


                            [
                                'name' => 'Mutasi',
                                'path' => route('mutasi'),
                                'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2',
                            ],
                        ];
                    @endphp
                    @foreach ($menus as $menu)
                        <a href="{{ $menu['path'] }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="flex items-center gap-3 px-4 py-2 w-6 h-6"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $menu['icon'] }}" />
                            </svg>
                            <span class="ml-3">{{ $menu['name'] }}</span>
                        </a>
                    @endforeach
                </ul>
            </nav>

            <div class="p-6 border-t border-white/10 text-xs text-white/60">
                © 2026 ElectricBlue
            </div>
        </div>

        <div class="flex-1 flex flex-col">
            <!-- HEADER -->
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Laporan Stok</div>
                </div>

                <div class="flex items-center gap-6">
                    <button onclick="alert('Notifikasi')"
                        class="w-10 h-10 flex items-center justify-center text-zinc-500 hover:text-[#1800AD] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9-5.197V8c0 .668-.149 1.297-.408 1.886L13 11v5.158c0 .558-.214 1.098-.595 1.491L19 17z" />
                        </svg>
                    </button>
                    <div class="relative">
                        <button type="button" onclick="toggleProfileMenu()"
                            class="flex items-center gap-3 focus:outline-none">

                            <div class="text-right">
                                <p class="font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Administrator
                                </p>
                            </div>
                            <div class="w-10 h-10 rounded-full
                                                bg-indigo-600 text-white
                                                flex items-center justify-center
                                                font-bold text-lg">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>

                        <div id="profileMenu" class="hidden absolute right-0 mt-3 w-56
                                                bg-white rounded-xl shadow-lg
                                                border border-gray-100 z-50">
                            <!-- Profil -->
                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3
                                                hover:bg-gray-100">
                                <span>👤</span>
                                <span>
                                    Lihat Profil
                                </span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3
                                                        px-4 py-3 text-left
                                                        hover:bg-gray-100 text-red-600">
                                    <span>🚪</span>
                                    <span>
                                        Logout
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <main class="max-w-6xl mx-auto px-4 py-8 space-y-6">

                <!-- FILTER -->
                <form method="GET" action="{{ route('laporanstok') }}" class="bg-white rounded-2xl shadow-sm p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Produk</label>
                    <div class="flex gap-3">
                        <select name="produk"
                            class="flex-1 border rounded-full px-5 py-3 text-sm bg-gray-50 focus:ring-2 focus:ring-indigo-400 outline-none">
                            <option value="">Pilih Produk</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}" @selected(request('produk') == $p->id_produk)>
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="px-8 rounded-full bg-[#7B61FF] text-white font-semibold hover:bg-[#6A4AD9]">
                            Cari
                        </button>
                    </div>
                    @error('produk')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </form>

                <!-- TABEL -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4">
                        <a href="{{ route('laporanstok.export', request()->query()) }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-[#7B61FF] hover:text-[#6A4AD9]">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 border-y text-gray-800">
                                    <th class="px-4 py-3 font-semibold">No Faktur</th>
                                    <th class="px-4 py-3 font-semibold">Barcode</th>
                                    <th class="px-4 py-3 font-semibold">Supplier</th>
                                    <th class="px-4 py-3 font-semibold">Kode</th>
                                    <th class="px-4 py-3 font-semibold">Produk</th>
                                    <th class="px-4 py-3 font-semibold text-right">Qty</th>
                                    <th class="px-4 py-3 font-semibold">Lokasi</th>
                                    <th class="px-4 py-3 font-semibold">Expired</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse ($stok as $s)
                                    @php
                                        $exp = $s->expired_date;
                                        $warna = 'text-gray-500';
                                        if ($exp) {
                                            if ($exp->isPast()) {
                                                $warna = 'text-red-600 font-semibold';          // sudah kedaluwarsa
                                            } elseif ($exp->lte(now()->addMonths(3))) {
                                                $warna = 'text-orange-500 font-semibold';       // < 3 bulan lagi
                                            }
                                        }
                                    @endphp
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-4 font-bold">{{ $s->no_faktur }}</td>
                                        <td class="px-4 py-4 font-mono text-xs">{{ $s->barcode }}</td>
                                        <td class="px-4 py-4">{{ $s->supplier->id_supplier ?? '-' }}</td>
                                        <td class="px-4 py-4 font-bold">{{ $s->produk->id_produk ?? '-' }}</td>
                                        {{-- <td class="px-4 py-4">{{ $s->produk-> ?? '-' }}</td> --}}
                                        <td class="px-4 py-4 text-right font-bold">{{ number_format($s->qty, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-4">{{ $s->lokasi ?? '-' }}</td>
                                        <td class="px-4 py-4 {{ $warna }}">{{ optional($exp)->expired_date ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-10 text-center text-gray-400">Data stok tidak
                                            ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PREVIOUS / NEXT -->
                <div class="flex justify-center gap-2">
                    @if ($stok->onFirstPage())
                        <span
                            class="px-5 py-2 rounded-full border text-sm text-gray-300 bg-white cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $stok->previousPageUrl() }}"
                            class="px-5 py-2 rounded-full border text-sm bg-white hover:bg-gray-50">Previous</a>
                    @endif

                    @if ($stok->hasMorePages())
                        <a href="{{ $stok->nextPageUrl() }}"
                            class="px-5 py-2 rounded-full border text-sm bg-white hover:bg-gray-50">Next</a>
                    @else
                        <span
                            class="px-5 py-2 rounded-full border text-sm text-gray-300 bg-white cursor-not-allowed">Next</span>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // ==================== TAILWIND INIT ====================
        // function initTailwind() {
    
        // }

        // ==================== DATA DUMMY (bisa diganti dengan PHP dari database) ====================
        // let allData = [
        //     {
        //         noFaktur: "INV-2026-001",
        //         barcode: "1234567890123",
        //         supplier: "PT. ABC Distribusi",
        //         kode: "PROD-001",
        //         produk: "Produk A - Vitamin C",
        //         qty: 245,
        //         lokasi: "Rak A-3",
        //         expired: "2027-02-15"
        //     },
        //     {
        //         noFaktur: "INV-2026-002",
        //         barcode: "9876543210987",
        //         supplier: "PT. XYZ Pharma",
        //         kode: "PROD-002",
        //         produk: "Produk B - Paracetamol",
        //         qty: 187,
        //         lokasi: "Rak B-5",
        //         expired: "2026-12-10"
        //     },
        //     // Tambahkan lebih banyak data dummy sesuai kebutuhan
        //     {
        //         noFaktur: "INV-2026-003",
        //         barcode: "4567891234567",
        //         supplier: "CV. Maju Bersama",
        //         kode: "PROD-003",
        //         produk: "Produk C - Obat Flu",
        //         qty: 320,
        //         lokasi: "Rak C-1",
        //         expired: "2027-05-20"
        //     }
        // ];

        // ==================== RENDER TABLE ====================
        // function renderTable(filteredData) {
        //     const tbody = document.getElementById('table-body');
        //     tbody.innerHTML = '';

        //     if (filteredData.length === 0) {
        //         tbody.innerHTML = `
        //             <tr>
        //                 <td colspan="8" class="text-center py-12 text-gray-400">
        //                     <i class="fas fa-search text-4xl mb-3"></i>
        //                     <p>Data tidak ditemukan</p>
        //                 </td>
        //             </tr>
        //         `;
        //         return;
        //     }

        //     filteredData.forEach(item => {
        //         const row = document.createElement('tr');
        //         row.className = 'border-b hover:bg-[#f0fdf4] transition-colors';
        //         row.innerHTML = `
        //             <td class="font-medium">${item.noFaktur}</td>
        //             <td class="font-mono text-xs">${item.barcode}</td>
        //             <td>${item.supplier}</td>
        //             <td class="font-medium">${item.kode}</td>
        //             <td>${item.produk}</td>
        //             <td class="text-right font-semibold">${item.qty}</td>
        //             <td>${item.lokasi}</td>
        //             <td class="text-sm text-gray-500">${item.expired}</td>
        //         `;
        //         tbody.appendChild(row);
        //     });
        // }

        // ==================== FILTER + CARI ====================
        // function applyFilter() {
        //     const selectedProduct = document.getElementById('produk-select').value;
        //     let filtered = allData;

        //     if (selectedProduct) {
        //         filtered = allData.filter(item =>
        //             item.produk.toLowerCase().includes(selectedProduct.toLowerCase()) ||
        //             item.kode.toLowerCase().includes(selectedProduct.toLowerCase())
        //         );
        //     }

        //     renderTable(filtered);
        // }

        // ==================== EXPORT EXCEL ====================
        // function exportExcel() {
        //     const table = document.getElementById('stok-table');
        //     const rows = table.querySelectorAll('tr');
        //     let csvContent = "No Faktur,Barcode,Supplier,Kode,Produk,Qty,Lokasi,Expired\n";

        //     rows.forEach((row, index) => {
        //         if (index === 0) return; // skip header
        //         const cols = row.querySelectorAll('td, th');
        //         const rowData = Array.from(cols).map(col =>
        //             `"${col.textContent.trim()}"`
        //         ).join(',');
        //         csvContent += rowData + "\n";
        //     });

        //     const encodedUri = encodeURI(csvContent);
        //     const link = document.createElement("a");
        //     link.setAttribute("href", encodedUri);
        //     link.setAttribute("download", "laporan-stok-lama.csv");
        //     document.body.appendChild(link);
        //     link.click();
        //     document.body.removeChild(link);
        // }

        // ==================== PAGINATION (contoh) ====================
        // let currentPage = 1;
        // const itemsPerPage = 10;

        // function renderPage() {
        //     const start = (currentPage - 1) * itemsPerPage;
        //     const end = start + itemsPerPage;
        //     renderTable(allData.slice(start, end));
        // }

        // function prevPage() {
        //     if (currentPage > 1) {
        //         currentPage--;
        //         renderPage();
        //     }
        // }

        // function nextPage() {
        //     const totalPages = Math.ceil(allData.length / itemsPerPage);
        //     if (currentPage < totalPages) {
        //         currentPage++;
        //         renderPage();
        //     }
        // }

        // ==================== INIT ====================
        // window.onload = function () {
        //     initTailwind();
        //     renderTable(allData); // tampilkan semua data awal
        // };
    </script>
</body>

</html>