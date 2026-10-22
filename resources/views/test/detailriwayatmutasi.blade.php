<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat Mutasi • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detailriwayatmutasi.css') }}">
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
                    <div class="text-2xl font-semibold text-[#1800AD]">Detail Riwayat Mutasi</div>
                </div>

                <div class="flex items-center gap-8">
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

            <main class="flex-1 p-8 overflow-auto bg-zinc-100">
                <div class="max-w-5xl mx-auto">
                    <div class="bg-white rounded-3xl shadow-sm p-6 mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xs text-zinc-500">NOMOR MUTASI</span>
                                <div class="text-2xl font-semibold text-[#1800AD]">00000000000001</div>
                            </div>
                            <button onclick="exportDetail()"
                                class="excel-btn flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 13v6m-3-3h6M6 21H4a2 2 0 01-2-2V5a2 2 0 012-2 2 2 0 01-2-2 2 2 0 012-2 2 2 0 01-2-2 2 2 0 012-2z" />
                                </svg>
                                Export Excel
                            </button>
                        </div>
                    </div>

                    <!-- TABEL DETAIL -->
                    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Nama Material</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Kode Product</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Kategori</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Barcode</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Qty</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Harga</th>
                                    <th class="py-5 px-6 text-left font-medium text-zinc-500">Petugas</th>
                                </tr>
                            </thead>
                            <tbody class="text-zinc-600">
                                <tr class="border-b hover:bg-zinc-50">
                                    <td class="py-5 px-6">Tempered Glass 14"</td>
                                    <td class="py-5 px-6">TGS14</td>
                                    <td class="py-5 px-6">Aksesoris</td>
                                    <td class="py-5 px-6">009090912</td>
                                    <td class="py-5 px-6 text-center">8</td>
                                    <td class="py-5 px-6">Rp 300.000</td>
                                    <td class="py-5 px-6">Paijo Mumet Ndase</td>
                                </tr>
                                <tr class="border-b hover:bg-zinc-50">
                                    <td class="py-5 px-6">Voucher XL 12GB 14 Hari</td>
                                    <td class="py-5 px-6">VX12</td>
                                    <td class="py-5 px-6">Voucher</td>
                                    <td class="py-5 px-6">124431414</td>
                                    <td class="py-5 px-6 text-center">10</td>
                                    <td class="py-5 px-6">Rp 300.000</td>
                                    <td class="py-5 px-6">Paijo Mumet Ndase</td>
                                </tr>
                                <tr class="border-b hover:bg-zinc-50">
                                    <td class="py-5 px-6">Gigi Berlubang 15H</td>
                                    <td class="py-5 px-6">GGS12</td>
                                    <td class="py-5 px-6">Elektronik</td>
                                    <td class="py-5 px-6">0102093920</td>
                                    <td class="py-5 px-6 text-center">5</td>
                                    <td class="py-5 px-6">Rp 300.000</td>
                                    <td class="py-5 px-6">Paijo Mumet Ndase</td>
                                </tr>
                                <tr class="border-b hover:bg-zinc-50">
                                    <td class="py-5 px-6">4 Sehat 5 Olahraga</td>
                                    <td class="py-5 px-6">4S5O</td>
                                    <td class="py-5 px-6">Rumah Tangga</td>
                                    <td class="py-5 px-6">6616276762</td>
                                    <td class="py-5 px-6 text-center">2</td>
                                    <td class="py-5 px-6">Rp 100.000</td>
                                    <td class="py-5 px-6">Paijo Ngantuk</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-50">
                                    <td class="py-5 px-6 font-semibold" colspan="4">Total</td>
                                    <td class="py-5 px-6 text-center font-bold">25</td>
                                    <td class="py-5 px-6 font-bold">Rp 1.000.000</td>
                                    <td class="py-5 px-6"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>