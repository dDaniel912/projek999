<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Lama • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stoklama.css') }}">
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

            <!-- Navigation -->
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

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- TOPBAR -->
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Stok Lama</div>
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

            <!-- CONTENT -->
            <main class="flex-1 p-8 overflow-auto bg-zinc-100">
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="px-8 py-5 flex items-center justify-between border-b">
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-lg">Laporan Stok Lama</span>
                            <span class="text-xs bg-zinc-100 px-3 py-1 rounded-full">100 Hari Terakhir</span>
                        </div>
                        <button onclick="exportExcel()"
                            class="excel-btn flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-2xl text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 13v6m-3-3h6M6 21H4a2 2 0 01-2-2V5a2 2 0 012-2 2 2 0 01-2-2 2 2 0 012-2 2 2 0 01-2-2 2 2 0 012-2z" />
                            </svg>
                            Excel
                        </button>
                    </div>

                    <!-- Filter Bulan -->
                    <div class="px-8 py-4 border-b flex items-center justify-end">
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 mb-1">Bulan</label>
                            <select id="bulan"
                                class="border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none">
                                <option value="2026-10">Oktober 2026</option>
                                <option value="2026-09">September 2026</option>
                                <option value="2026-08">Agustus 2026</option>
                            </select>
                        </div>
                    </div>

                    <!-- TABEL -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Nama Produk</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Barcode</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Harga</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Qty</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Lokasi</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Tanggak</th>
                                </tr>
                            </thead>
                            <tbody id="table-body" class="text-zinc-600">
                                <!-- Data akan diisi oleh JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Data dummy
        let stokData = [
            { nama: "BATRE MEDIUM 170", barcode: "SRVB-02", harga: "Rp 400.000", qty: 5, lokasi: "Jakarta" },
            { nama: "BATRE MEDIUM 200", barcode: "SRVB-05", harga: "Rp 320.000", qty: 15, lokasi: "Bandung" },
            { nama: "BATRE MEDIUM 250", barcode: "SRVB-10", harga: "Rp 430.000", qty: 6, lokasi: "Surabaya" },
            { nama: "BATRE MEDIUM 300", barcode: "SRVB-15", harga: "Rp 370.000", qty: 8, lokasi: "Jakarta" },
        ];

        function renderTable(data) {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="py-20 text-center text-zinc-400">
                            Tidak ada data stok lama
                        </td>
                    </tr>`;
                return;
            }

            data.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'border-b hover:bg-zinc-50';
                row.innerHTML = `
                    <td class="py-5 px-6">${item.nama}</td>
                    <td class="py-5 px-6">${item.barcode}</td>
                    <td class="py-5 px-6">${item.harga}</td>
                    <td class="py-5 px-6 text-center">${item.qty}</td>
                    <td class="py-5 px-6">${item.lokasi}</td>
                `;
                tbody.appendChild(row);
            });
        }

        function exportExcel() {
            alert('✅ File Excel Laporan Stok Lama telah diunduh!');
        }

        // Inisialisasi
        window.onload = function () {
            renderTable(stokData);
            console.log('%c✅ Laporan Stok Lama Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
        };
    </script>
</body>

</html>