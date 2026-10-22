<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Penambahan - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
        }

        .sidebar {
            background-color: #1800AD;
            color: white;
        }

        .header {
            background-color: #1800AD;
            color: white;
        }

        .card,
        .table-container {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .table th {
            background-color: #f8fafc;
            color: #374151;
            font-weight: 600;
        }

        .table tr:hover {
            background-color: #f0fdf4;
        }

        .accent-btn {
            background-color: #7B61FF;
            color: white;
            transition: all 0.2s;
        }

        .accent-btn:hover {
            background-color: #6A4AD9;
            transform: translateY(-1px);
        }

        .table td {
            padding: 12px 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .active {
            background-color: #d4edda;
            color: #155724;
        }

        .inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="sidebar w-64 flex flex-col">
            <div class="p-6 flex items-center gap-3 border-b border-blue-800">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-2xl">🦎</div>
                <div>
                    <h1 class="text-white text-2xl font-bold tracking-tight">ElectricBlue</h1>
                    <p class="text-xs text-blue-200">Inventory System</p>
                </div>
            </div>

            <nav class="flex-1 p-4">
                <ul class="space-y-1">
                    @php
                        $menus = [
                            [
                                'name' => 'Dashboard',
                                'path' => route('dashboard'),
                                'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1'
                            ],
                            [
                                'name' => 'Penjualan',
                                'path' => route('penjualan'),
                                'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                            ],
                            [
                                'name' => 'Persediaan Stok',
                                'path' => route('persediaan'),
                                'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
                            ],
                            [
                                'name' => 'Mutasi',
                                'path' => route('mutasi'),
                                'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2'
                            ],
                        ];
                    @endphp
                    @foreach ($menus as $menu)
                        <li>
                            <a href="{{ $menu['path'] }}"
                                class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $menu['icon'] }}" />
                                </svg>
                                <span>{{ $menu['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="p-4 border-t border-blue-800 text-xs text-blue-300">v1.0 • 2026</div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="text-2xl font-semibold text-[#1800AD]">Dashboard</div>

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
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </button>

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border border-gray-100 z-50">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100">
                                <span>👤</span><span>Lihat Profil</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-gray-100 text-red-600">
                                    <span>🚪</span><span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-4">
                            <strong>Gagal menyimpan:</strong>
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-3 gap-6">
                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalProduk')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-boxes text-5xl mb-3"></i>
                                Tambah Produk
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalCabang')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-building text-5xl mb-3"></i>
                                Tambah Cabang
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalAkun')" class="bg-gray-300 hover:bg-gray-400 rounded-2xl
                            shadow-md p-5 w-48 h-28
                            flex flex-col items-center justify-center
                            transition duration-200">
                                <i class="fa-solid fa-user-plus text-4xl mb-2"></i>
                                <span class="text-xl font-semibold">
                                    Tambah Akun
                                </span>
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalKategori')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-tags text-5xl mb-3"></i>
                                <span class="text-xl font-semibold">
                                    Tambah Kategori
                                </span>
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalSupplier')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-truck text-5xl mb-3"></i>
                                Tambah Supplier
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalCustomer')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-users text-5xl mb-3"></i>
                                Tambah Customers
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" onclick="bukaModal('modalBukaAkun')"
                                class="w-52 h-32 bg-gray-300 hover:bg-gray-400 text-black font-semibold rounded-2xl flex flex-col items-center justify-center text-2xl shadow-md transition-all active:scale-95">
                                <i class="fas fa-users text-5xl mb-3"></i>
                                Tambah Customers
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalProduk" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Produk
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan Produk Baru
                    </p>
                </div>
                <button type="button" onclick="tutupModal()" class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
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
                        <input type="number" name="barcode" value="{{ old('barcode') }}"
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
                            <input id="modal-jumlah" type="text" name="merk_produk" value="{{ old('merk_produk') }}"
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
                        <input id="modal-hpp" type="text" name="deskripsi" value="{{ old('deskripsi') }}"
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
                    <button onclick="tutupModal()"
                        class="px-8 py-3 border border-zinc-300 rounded-2xl font-medium">Batal</button>
                    <button type="submit"
                        class="bg-[#1800AD] text-white px-8 py-3 rounded-2xl font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalKategori" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Kategori
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan Kategori Baru
                    </p>
                </div>
                <button type="button" onclick="tutupModal()" class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Kategori
                    </label>
                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Id Unik
                    </label>
                    <input type="text" name="parent_id" value="{{ old('parent_id') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="tutupModal()" class="px-5 py-3 rounded-xl border hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1800AD]
                               text-white hover:bg-indigo-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalAkun" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">

        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Akun
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan akun petugas baru
                    </p>
                </div>
                <button type="button" onclick="tutupModal()" class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <form action="{{ route('akun.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Petugas
                    </label>
                    <input type="text" name="nama_petugas" value="{{ old('nama_petugas') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Username
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                        required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Password
                    </label>
                    <input type="password" name="password" minlength="8" placeholder="Minimal 8 karakter" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Role
                    </label>
                    <select name="role" required class="w-full border rounded-xl px-4 py-3 bg-white">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="gudang">Gudang</option>
                        <option value="kasir">Kasir</option>
                        <option value="purchasing">Purchasing</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Status Akun
                    </label>
                    <select name="is_active" required class="w-full border rounded-xl px-4 py-3 bg-white">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="tutupModal()" class="px-5 py-3 rounded-xl border hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1800AD]
                               text-white hover:bg-indigo-800">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalCabang" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Cabang
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan cabang baru
                    </p>
                </div>
                <button type="button" onclick="tutupModal('modalCabang')"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <form action="{{ route('cabang.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label>ID Cabang Otomatis (Urut):</label>
                    <input type="text" name="id_cabang" value="{{ old('id_cabang') }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Kode Cabang
                    </label>
                    <input type="text" name="kode_cabang" value="{{ old('kode_cabang') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Cabang
                    </label>
                    <input type="text" name="nama_cabang" value="{{ old('nama_cabang') }}"
                        placeholder="Masukkan username" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Alamat
                    </label>
                    <input type="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat Cabang" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nomor HP
                    </label>
                    <input type="phone" name="phone" id="phone" value="{{ old('phone') }}" minlength="8"
                        placeholder="Minimal 8 karakter" class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="luigis@gmail.com" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Status
                    </label>
                    <select name="is_active" required class="w-full border rounded-xl px-4 py-3 bg-white">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input value="{{ old('is_active') }}">
                </div>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="tutupModal('modalCabang')" class=" px-5 py-3 rounded-xl border
                        hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1800AD]
                               text-white hover:bg-indigo-800">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalSupplier" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Supplier
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan supplier baru
                    </p>
                </div>
                <button type="button" onclick="tutupModal('modalSupplier')"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <form action="{{ route('supplier.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Supplier
                    </label>
                    <input type="text" name="nama_supplier" value="{{ old('nama_supplier') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Phone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Masukkan username" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Alamat
                    </label>
                    <input type="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat Cabang" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="tutupModal('modalSupplier')" class=" px-5 py-3 rounded-xl border
                        hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1800AD]
                               text-white hover:bg-indigo-800">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalCustomer" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Tambah Customer
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan customer
                    </p>
                </div>
                <button type="button" onclick="tutupModal('modalCustomer')"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <form action="{{ route('customer.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Nama Customer
                    </label>
                    <input type="text" name="nama_customer" value="{{ old('nama_customer') }}"
                        placeholder="Masukkan nama petugas" required class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Phone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Masukkan username" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Alamat
                    </label>
                    <input type="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat Cabang" required
                        class="w-full border rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" onclick="tutupModal('modalCustomer')" class=" px-5 py-3 rounded-xl border
                        hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1800AD]
                               text-white hover:bg-indigo-800">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div id="modalBukaAkun" class="fixed inset-0 z-50 hidden items-center justify-center
            bg-black/50 p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl
                max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between
                    px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-bold text-[#1800AD]">
                        Daftar Akun Petugas
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tambahkan customer
                    </p>
                </div>
                <button type="button" onclick="tutupModal('modalCustomer')"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terakhir Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar_petugas as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->nama_petugas }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->email }}</td>
                                <td><strong>{{ strtoupper($row->role) }}</strong></td>
                                <td>
                                    @if ($row->is_active == 1)
                                        <span class="badge active">Aktif</span>
                                    @else
                                        <span class="badge inactive">Non-Aktif</span>
                                    @endif
                                </td>
                                <td>{{ $row->last_login_at ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <script>
        const daftarModal = ['modalAkun', 'modalKategori', 'modalCabang', 'modalProduk', 'modalSupplier', 'modalCustomer', 'modalBukaAkun'];

        function bukaModal(idModal) {
            daftarModal.forEach(id => {
                const m = document.getElementById(id);
                if (m) {
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                }
            });

            const modalAktif = document.getElementById(idModal);
            if (modalAktif) {
                modalAktif.classList.remove('hidden');
                modalAktif.classList.add('flex');
            }
        }

        function tutupModal() {
            daftarModal.forEach(id => {
                const m = document.getElementById(id);
                if (m) {
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                }
            });
        }
        // async function bukaModalCabang() {
        //     const input = document.getElementById('id_cabang');
        //     input.value = 'Memuat...';
        //     openModal('modalCabang');
        //     try {
        //         const res = await fetch("{{ route('cabang.nextId') }}", { headers: { 'Accept': 'application/json' } });
        //         const data = await res.json();
        //         input.value = data.id_cabang;
        //     } catch (e) {
        //         input.value = '';
        //         alert('Gagal mengambil ID cabang');
        //     }
        // }

        // function toggleProfileMenu() {
        //     document.getElementById('profileMenu').classList.toggle('hidden');
        // }

        // // Tutup modal jika area luar kotak diklik
        // window.onclick = function (event) {
        //     if (event.target.id === 'modalCabang') closeModal('modalCabang');
        //     if (event.target.id === 'modalUser') closeModal('modalUser');
        // }

        // // Jika validasi gagal, buka kembali pop up cabang (data lama tetap terisi)
        // @if ($errors->any() && old('kode_cabang') !== null)
            //     openModal('modalCabang');
        // @endif
    </script>
</body>

</html>