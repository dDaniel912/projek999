<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STOK • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/stok.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
</head>

<body class="tail-container bg-zinc-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <div class="sidebar-bg w-72 flex flex-col text-white shadow-2xl">
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
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">STOK</div>
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
                <div class="grid grid-cols-4 gap-6">
                    <div class="card-big bg-white p-8 rounded-3xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="text-xs text-zinc-500">TOTAL STOK</div>
                                <div class="text-5xl font-bold text-[#1800AD] mt-2"></div>
                            </div>
                            <div
                                class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl">
                                📦</div>
                        </div>
                        <button onclick="alert('Lihat semua stok')"
                            class="lks-btn mt-6 text-blue-600 font-medium text-sm hover:underline">
                            Lihat Semua
                        </button>
                    </div>

                    <div class="card-big bg-white p-8 rounded-3xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="text-xs text-zinc-500">HAMPIR EXPIRED</div>
                                <div class="text-5xl font-bold text-[#1800AD] mt-2"></div>
                            </div>
                            <div
                                class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-3xl">
                                ⏰</div>
                        </div>
                        <button onclick="alert('Lihat hampir expired')"
                            class="lks-btn mt-6 text-blue-600 font-medium text-sm hover:underline">
                            Lihat Semua
                        </button>
                    </div>

                    <div class="card-big bg-white p-8 rounded-3xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="text-xs text-zinc-500">STOK MENIPIS</div>
                                <div class="text-5xl font-bold text-[#1800AD] mt-2"></div>
                            </div>
                            <div
                                class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-3xl">
                                ⚠️</div>
                        </div>
                        <button onclick="alert('Lihat stok menipis')"
                            class="lks-btn mt-6 text-blue-600 font-medium text-sm hover:underline">
                            Lihat Semua
                        </button>
                    </div>

                    <div class="card-big bg-white p-8 rounded-3xl">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="text-xs text-zinc-500">MUTASI PENDING</div>
                                <div class="text-5xl font-bold text-[#1800AD] mt-2"></div>
                            </div>
                            <div
                                class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-3xl">
                                🔄</div>
                        </div>
                        <button onclick="alert('Lihat mutasi pending')"
                            class="lks-btn mt-6 text-blue-600 font-medium text-sm hover:underline">
                            Lihat Semua
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-6">
                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('laporanstok') }}">
                                <div class="text-center font-semibold mb-6 mt-6">📊Laporan Stok</div>
                            </a>
                        </div>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('stoklama') }}">
                                <div class="text-center font-semibold mb-6 mt-6">🗃Stok Lama</div>
                            </a>
                        </div>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <a href="{{ route('pembelian') }}">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <div class="text-center font-semibold mb-6 mt-6">🛒Pembelian</div>
                        </div>
                        </a>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('datastok') }}">
                                <div class="text-center font-semibold mb-6 mt-6">📋Data Stok Barang</div>
                        </div>
                        </a>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('stokopname') }}">
                                <div class="text-center font-semibold mb-6 mt-6">📝Stock Opname</div>
                            </a>
                        </div>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <a href="{{  route('barcodesku') }}">
                            <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                                <div class="text-center font-semibold mb-6 mt-6">🖨Barcode & SKU</div>
                            </div>
                        </a>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('mutasi') }}">
                                <div class="text-center font-semibold mb-6 mt-6">🏍Mutasi</div>
                            </a>
                        </div>
                    </button>

                    <button class="lks-btn text-sm hover:underline">
                        <div class="bg-white p-6 rounded-3xl min-h-[100px] flex items-center justify-center">
                            <a href="{{ route('test.kartustok') }}">
                                <div class="text-center font-semibold mb-6 mt-6">📄Kartu Stok</div>
                            </a>
                        </div>
                    </button>
                </div>
            </main>
        </div>
    </div>
</body>

</html>