<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Stok Barang • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/datastok.css') }}">
</head>

<body class="tail-container bg-zinc-100 min-h-screen">
    @if (session('success'))
        <div class="mb-4 rounded-xl bg-green-100 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif
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
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Data Stok Barang</div>
                </div>
                <div class="flex items-center gap-8">
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
                <!-- STATS BAR -->
                <div class="grid grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-3xl">
                        <div class="text-xs text-zinc-500">Jumlah Barang</div>
                        <div id="jumlah-barang" class="text-4xl font-bold text-[#1800AD]"></div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl">
                        <div class="text-xs text-zinc-500">Barang Masuk</div>
                        <div id="barang-masuk" class="text-4xl font-bold text-[#1800AD]"></div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl">
                        <div class="text-xs text-zinc-500">Barang Keluar</div>
                        <div id="barang-keluar" class="text-4xl font-bold text-[#1800AD]"></div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl">
                        <div class="text-xs text-zinc-500">Stok Menipis</div>
                        <div class="text-4xl font-bold text-[#1800AD]"></div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 mb-6 flex items-end gap-4">

                    <div class="relative w-full max-w-lg" id="search-container">
                        <label for="search-user" class="block text-sm font-medium mb-2">
                            Cari Produk
                        </label>

                        <input type="text" id="search-user" placeholder="Ketik nama petugas..." autocomplete="off"
                            class="w-full rounded-xl border border-gray-300
               px-4 py-3 outline-none
               focus:ring-2 focus:ring-indigo-500">
                        <div id="search-results" class="hidden absolute left-0 right-0 top-full mt-2
                bg-white border border-gray-200 rounded-xl
                shadow-lg overflow-hidden z-50">
                        </div>
                        <input type="hidden" name="user_id" id="selected-user-id">

                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Filter</label>
                        <form action="{{ url('datastok') }}" method="GET">
                            <label for="kategori">Filter Kategori</label>
                            <select name="kategori" id="kategori" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                {{-- @foreach ($kategori as $item)
                                    <option value="{{ $item }}" {{ request('kategori') == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </form>
                    </div>

                </div>
                <!-- TABLE -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
                    <table class="w-full">
                        <thead>
                            <tr class="table-header">
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Id Produk</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Kode Product</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Barcode</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Nama Produk</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Kategori</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Merk</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Jumlah</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">HPP</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Harga</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Deskripsi</th>
                                <th class="py-4 px-6 text-left font-medium text-zinc-500">Status</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="text-zinc-600">
                            @forelse ($produks as $produk)
                                <tr class="border-t">
                                    <td class="p-4">{{ $produk->id_produk ?? '-'}}</td>
                                    <td class="p-4">{{ $produk->kode_produk ?? '-'}}</td>
                                    <td class="p-4">{{ $produk->barcode ?? '-'}}</td>
                                    <td class="p-4">{{ $produk->nama_produk ?? '-'}}</td>
                                    <td class="p-4">{{ $produk->nama_kategori ?? '-' }}</td>
                                    <td class="p-4">{{ $produk->merk_produk ?? '-'}}</td>
                                    <td class="p-4">{{ $produk->unit ?? '-'}}</td>
                                    <td class="p-4"> Rp {{ number_format($produk->cost_price ?? 0, 0, ',', '.') }} </td>
                                    <td class="p-4"> Rp {{ number_format($produk->selling_price ?? 0, 0, ',', '.') }} </td>
                                    <td class="p-4">{{ $produk->deskripsi ?? '-'}}</td>
                                    <td class="p-4">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full {{ $produk->jumlah > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $produk->unit > 0 ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center"> Belum ada data produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    {{-- @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-4">
        <strong>Produk gagal disimpan:</strong>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <!-- ADD PRODUCT MODAL -->
    {{-- <div id="add-modal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-8 py-6 border-b flex items-center justify-between">
                <h3 class="text-2xl font-semibold">Tambah Produk Baru</h3>
                <button onclick="hideAddModal()"
                    class="text-3xl leading-none text-zinc-400 hover:text-zinc-600">×</button>
            </div>

            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">ID Produk</label>
                        <input type="text" name="id_produk" value="{{ old('id_produk') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Kode Produk</label>
                        <input type="text" name="kode_produk" value="{{ old('kode_produk') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Barcode</label>
                        <input type="text" name="barcode" value="{{ old('barcode') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 mb-1">ID Kategori</label>
                            <input type="number" name="id_kategori" value="{{ old('id_kategori') }}"
                                class="w-full border border-zinc-300 rounded-2xl px-5 py-3" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 mb-1">Merek Produk</label>
                            <input id="modal-jumlah" type="number" name="merk_produk" value="{{ old('merk_produk') }}"
                                required
                                class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none ">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 mb-1">Jumlah</label>
                            <input id="modal-jumlah" type="number" name="unit" value="{{ old('unit') }}" required
                                class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none ">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 mb-1">Harga</label>
                            <input id="modal-harga" type="number" name="selling_price"
                                value="{{ old('selling_price') }}"
                                class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">HPP</label>
                        <input id="modal-hpp" type="number" name="cost_price" value="{{ old('cost_price') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Deskripsi</label>
                        <input id="modal-hpp" type="number" name="deskripsi" value="{{ old('deskripsi') }}"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Status Aktif</label>
                        <select name="is_active" class="w-full border rounded-2xl px-5 py-3" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Habis</option>
                        </select>
                    </div>
                </div>
                <div class="p-6 border-t flex justify-end gap-3">
                    <button onclick="hideAddModal()"
                        class="px-8 py-3 border border-zinc-300 rounded-2xl font-medium">Batal</button>
                    <button type="submit"
                        class="bg-[#1800AD] text-white px-8 py-3 rounded-2xl font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div> --}}