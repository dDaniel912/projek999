<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stok • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/kartustok.css') }}">
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
                    <div class="text-2xl font-semibold text-[#1800AD]">Kartu Stok</div>
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

                    <div onclick="alert('Profil')" class="flex items-center gap-3 cursor-pointer">
                        <div class="text-right">
                            <div class="text-sm font-semibold text-zinc-700">Admin</div>
                        </div>
                        <div
                            class="w-9 h-9 bg-gradient-to-br from-[#1800AD] to-[#7B61FF] rounded-2xl flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- FILTER BAR -->
            <div class="bg-white border-b p-6">
                <div class="grid grid-cols-5 gap-4">
                    <!-- Nama Product -->
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Nama Product</label>
                        <input type="text" id="nama-product"
                            class="search-input w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-5 py-3 text-sm outline-none"
                            placeholder="Contoh: BATRE MEDIUM">
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button onclick="cariKartu()"
                            class="bg-[#1800AD] hover:bg-[#120080] text-white font-medium px-8 py-3 rounded-2xl w-full transition-colors">
                            Cari
                        </button>
                    </div>
                </div>
            </div>

            <!-- HASIL PENCARIAN -->
            <div class="flex-1 p-8 overflow-auto bg-zinc-100">
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <!-- HEADER HASIL -->
                    <div class="result-header px-8 py-5 flex items-center justify-between">
                        <div>
                            <span class="font-medium text-lg">Hasil Pencarian "B"</span>
                        </div>
                    </div>

                    <!-- TABEL HASIL -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="py-4 px-6 text-left font-medium text-zinc-500">Nama Product</th>
                                    <th class="py-4 px-6 text-left font-medium text-zinc-500">Detail</th>
                                </tr>
                            <tbody>
                                @foreach ($stok as $produk)
                                    <tr class="border-t">
                                        <td class="p-4">
                                            <a href="{{ route('insidekartustok', $produk->id_produk) }}" class="text-blue-700 hover:text-blue-900
                                                            hover:underline font-medium">
                                                {{ $produk->nama_produk }}
                                            </a>
                                        </td>
                                        <td class="p-4">
                                            <a href="{{ route('insidekartustok', $produk->id_produk) }}"
                                                class="text-blue-700 hover:underline">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- @forelse ($produkkartu as $produk)
                            <tr class="border-t">
                                <td class="p-4">{{ $produk->nama_produk }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="p-4" colspan="1">Tidak ada data produk.</td>
                            </tr>
                            @endforelse --}}
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function renderTabel(data) {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="2" class="py-16 text-center text-zinc-400">
                            Tidak ada hasil pencarian
                        </td>
                    </tr>`;
                return;
            }

            data.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'border-b hover:bg-zinc-50';
                row.innerHTML = `
                    <td class="py-5 px-6 font-medium">${item.nama}</td>
                    <td class="py-5 px-6">${item.detail}</td>
                `;
                tbody.appendChild(row);
            });
        }

        function cariKartu() {
            const term = document.getElementById('nama-product').value.toLowerCase();

            let filtered = hasilPencarian;

            if (term) {
                filtered = filtered.filter(item => item.nama.toLowerCase().includes(term));
            }

            renderTabel(filtered);
        }

        // Inisialisasi
        window.onload = function () {
            renderTabel(hasilPencarian);
            console.log('%c✅ Kartu Stok Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
        };
    </script>
</body>

</html>