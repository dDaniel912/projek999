<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard • PT. ElectricBlue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

                            // [
                            //     'nama' => 'Cek Modal',
                            //     'path' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            // ],

                            // [
                            //     'nama' => 'Kelola Produk',
                            //     'path' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2',
                            // ],

                            // [
                            //     'nama' => 'Pembelian',
                            //     'path' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z',
                            // ],

                            // [
                            //     'nama' => 'Laporan',
                            //     'path' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            // ],

                            // [
                            //     'nama' => 'Akuntansi',
                            //     'path' => 'M9 7h6m0 10H9m-7 0h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            // ],

                            // [
                            //     'nama' => 'Promo',
                            //     'path' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                            // ],

                            // [
                            //     'nama' => 'PPOB',
                            //     'path' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 4.01V8',
                            // ],

                            // [
                            //     'nama' => 'Karyawan',
                            //     'path' => 'M12 4.354a4 4 0 110 5.292M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z',
                            // ],

                            // [
                            //     'nama' => 'Insentif',
                            //     'path' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            // ],

                            // [
                            //     'nama' => 'Pelanggan',
                            //     'path' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            // ],

                            // [
                            //     'nama' => 'Servis',
                            //     'path' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 002.573-1.066c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37z',
                            // ],

                            // [
                            //     'nama' => 'Akun Kasir',
                            //     'path' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            // ],

                            // [
                            //     'nama' => 'Template Nota',
                            //     'path' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2 2 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                            // ],

                            // [
                            //     'nama' => 'Sembunyikan Lokasi',
                            //     'path' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
                            // ],
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
                © 2026 ElectricBlue • All rights reserved
            </div>
        </div>

        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Dashboard</div>
                </div>

                <div class="flex items-center gap-8">
                    <div class="relative">
                        <input type="text"
                            class="w-72 bg-zinc-100 border border-transparent focus:border-[#1800AD] focus:ring-1 focus:ring-[#1800AD] rounded-3xl py-3 px-6 text-sm placeholder-zinc-400 outline-none transition-all"
                            placeholder="Cari transaksi, stok, atau pelanggan...">
                        <button onclick="alert('Search feature coming soon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 bg-[#1800AD] text-white w-9 h-9 rounded-2xl flex items-center justify-center hover:bg-[#120080] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>

                    <button onclick="alert('Notifikasi (belum ada data baru)')"
                        class="relative w-10 h-10 flex items-center justify-center text-zinc-500 hover:text-[#1800AD] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9-5.197V8c0 .668-.149 1.297-.408 1.886L13 11v5.158c0 .558-.214 1.098-.595 1.491L19 17z" />
                        </svg>
                        <span
                            class="absolute top-1 right-1 w-5 h-5 bg-[#2ED573] text-[10px] font-bold text-white rounded-full flex items-center justify-center">3</span>
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

            <main class="flex-1 p-8 overflow-auto">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h1 class="text-4xl font-semibold text-zinc-800">Selamat datang kembali, Admin 👋</h1>
                        <p class="text-zinc-500 mt-1">Selamat datang di dashboard ElectricBlue. Semua data hari ini
                            sudah terupdate.</p>
                    </div>
                    <div class="text-right">
                        <div class="tanggal-hari">
                            <div class="label">HARI INI</div>
                            <div class="tanggal" id="tanggal-hari"></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">⚙️</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">SET UP</h3>
                            <p class="text-zinc-400">Pengaturan sistem</p>
                        </div>
                    </div>

                    <div onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">💼</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">TRANSAKSI</h3>
                            <p class="text-zinc-400">Proses transaksi</p>
                        </div>
                    </div>

                    <div onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">📊</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">LAPORAN FINANCE</h3>
                            <p class="text-zinc-400">Laporan keuangan</p>
                        </div>
                    </div>

                    <div onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">📈</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">LAPORAN FL</h3>
                            <p class="text-zinc-400">Laporan Fulfillment</p>
                        </div>
                    </div>

                    <div onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">🛒</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">PENJUALAN</h3>
                            <p class="text-zinc-400">Transaksi harian</p>
                        </div>
                    </div>

                    <a href="{{ route('stok') }}" onclick="activateButton(this)"
                        class="menu-card group cursor-pointer rounded-3xl overflow-hidden block">
                        <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                        <div class="p-8 text-center">
                            <div
                                class="w-20 h-20 mx-auto bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                <span class="text-5xl">📦</span>
                            </div>
                            <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">STOK</h3>
                            <p class="text-zinc-400">Manajemen stok</p>
                        </div>
                    </a>

                    <a href="{{ route('mutasi') }}">
                        <div onclick="activateButton(this)"
                            class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                            <div class="p-8 flex flex-col items-center justify-center text-center">
                                <div
                                    class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                    <span class="text-5xl">🔄</span>
                                </div>
                                <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">MUTASI</h3>
                                <p class="text-zinc-400">Mutasi barang</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('pengaturan') }}">
                        <div onclick="activateButton(this)"
                            class="menu-card group cursor-pointer rounded-3xl overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-[#1800AD] via-[#7B61FF] to-transparent"></div>
                            <div class="p-8 flex flex-col items-center justify-center text-center">
                                <div
                                    class="w-20 h-20 bg-[#1800AD]/5 rounded-3xl flex items-center justify-center mb-6 group-active:scale-90 transition-transform">
                                    <span class="text-5xl">🔄</span>
                                </div>
                                <h3 class="text-3xl font-semibold text-[#7B61FF] mb-1">Pengaturan</h3>
                                <p class="text-zinc-400">Atur aja sendiri</p>
                            </div>
                        </div>
                    </a>
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>