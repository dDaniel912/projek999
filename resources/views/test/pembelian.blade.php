<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pembelian.css') }}">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="sidebar w-64 flex flex-col">
            <!-- Logo + Header -->
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

            <!-- Footer -->
            <div class="p-4 border-t border-blue-800 text-xs text-blue-300">
                v1.0 • 2026
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- HEADER -->
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Barcode & SKU</div>
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

            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <div class="card p-6 mb-8">
                        <div class="flex items-end gap-6">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">No Penerimaan</label>
                                <div class="flex gap-3">
                                    <input id="no-penerimaan-input" type="text" placeholder="Cari no penerimaan..."
                                        class="flex-1 bg-gray-50 border border-gray-300 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:border-2 focus:border-[#7B61FF]">
                                    <button onclick="applyFilter()"
                                        class="px-8 bg-[#7B61FF] hover:bg-[#6A4AD9] text-white font-medium rounded-2xl transition-all">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="card">
                        <div class="px-6 py-5 border-b flex justify-between items-center">
                            <h3 class="font-semibold text-lg">Daftar Pembelian / Penerimaan</h3>
                            <button onclick="exportExcel()"
                                class="text-[#7B61FF] hover:text-[#6A4AD9] flex items-center gap-2 text-sm font-medium">
                                <i class="fas fa-file-excel"></i>
                                <span>Export Excel</span>
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table id="stok-table" class="table w-full">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left">No Penerimaan</th>
                                        <th class="text-left">Supplier</th>
                                        <th class="text-left">No PO</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-left">Tanggal</th>
                                        <th class="text-left">Petugas</th>
                                        <th class="text-left">Cabang</th>
                                        <th class="text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body" class="text-sm">
                                    <!-- JS akan isi tabel -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lihat Detail --}}
    <div id="detailAksi" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
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
                    {{-- <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1">Status</label>
                        <select id="modal-status"
                            class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Menipis">Menipis</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div> --}}
                </div>
                {{-- <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1">Kategori</label>
                    <select id="modal-kategori"
                        class="w-full border border-zinc-300 rounded-2xl px-5 py-3 text-sm outline-none value=" {{
                        old('kategori') }}">
                        @if(session('success'))
                        <p style="color: green;">
                            {{ session('success')}}
                        </p>
                        @endif
                        @if ($errors->any())
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <option value="">Pilih Kategori</option>
                        <option value="Voucher">Voucher</option>
                        <option value="Perdana">Perdana</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Aksesoris">Aksesoris</option>
                        <option value="Service">Service</option>
                        <option value="Alat-Rumah-Tangga">Alat Rumah Tangga</option>
                        <option value="Sparepart">Sparepart</option>
                    </select>
                </div> --}}
                <div class="p-6 border-t flex justify-end gap-3">
                    <button onclick="hideAddModal()"
                        class="px-8 py-3 border border-zinc-300 rounded-2xl font-medium">Batal</button>
                    <button type="submit"
                        class="bg-[#1800AD] text-white px-8 py-3 rounded-2xl font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // ==================== TAILWIND INIT ====================
        function initTailwind() {
            // Tailwind sudah di-load via CDN
        }

        // ==================== DATA DUMMY (bisa diganti dengan PHP dari database) ====================
        let allData = [
            {
                noPenerimaan: "213213123",
                supplier: "koaadwlda",
                noPO: "1232312321312",
                status: "Sesuai",
                tanggal: "09-12-2026",
                petugas: "Paranormal",
                cabang: "Sana-Sini"
            },
            {
                noPenerimaan: "987654321",
                supplier: "PT. ABC Distribusi",
                noPO: "PO-2026-001",
                status: "Sesuai",
                tanggal: "10-12-2026",
                petugas: "Rina",
                cabang: "Sana-Sini"
            },
            {
                noPenerimaan: "112233445",
                supplier: "CV. Maju Bersama",
                noPO: "PO-2026-002",
                status: "Sesuai",
                tanggal: "11-12-2026",
                petugas: "Budi",
                cabang: "Sana-Sini"
            }
        ];

        // ==================== RENDER TABLE ====================
        function renderTable(filteredData) {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-12 text-gray-400">
                            <i class="fas fa-search text-4xl mb-3"></i>
                            <p>Data tidak ditemukan</p>
                        </td>
                    </tr>
                `;
                return;
            }

            filteredData.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'border-b hover:bg-[#f0fdf4] transition-colors';
                row.innerHTML = `
                    <td class="font-medium">${item.noPenerimaan}</td>
                    <td>${item.supplier}</td>
                    <td class="font-mono">${item.noPO}</td>
                    <td>${item.status}</td>
                    <td>${item.tanggal}</td>
                    <td>${item.petugas}</td>
                    <td>${item.cabang}</td>
                    <td>
                        <button onclick="detailAksi('${item.noPenerimaan}')" 
                                class="text-[#7B61FF] hover:text-[#6A4AD9] flex items-center gap-1 text-sm font-medium">
                            <i class="fas fa-eye"></i>
                            <span>Detail</span>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // ==================== FILTER + CARI ====================
        function applyFilter() {
            const noPenerimaanInput = document.getElementById('no-penerimaan-input').value.toLowerCase();
            let filtered = allData;

            if (noPenerimaanInput) {
                filtered = allData.filter(item =>
                    item.noPenerimaan.toLowerCase().includes(noPenerimaanInput) ||
                    item.noPO.toLowerCase().includes(noPenerimaanInput)
                );
            }

            renderTable(filtered);
        }

        // ==================== EXPORT EXCEL ====================
        function exportExcel() {
            const table = document.getElementById('stok-table');
            const rows = table.querySelectorAll('tr');
            let csvContent = "No Penerimaan,Supplier,No PO,Status,Tanggal,Petugas,Cabang,Aksi\n";

            rows.forEach((row, index) => {
                if (index === 0) return; // skip header
                const cols = row.querySelectorAll('td, th');
                const rowData = Array.from(cols).map(col =>
                    `"${col.textContent.trim()}"`
                ).join(',');
                csvContent += rowData + "\n";
            });

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "laporan-pembelian.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // ==================== DETAIL (placeholder) ====================
        // function detailAksi(noPenerimaan) {
        //     alert(`Detail pembelian untuk No Penerimaan: ${noPenerimaan}\n\n(Fitur ini akan dikembangkan di masa depan)`);
        // }

        // ==================== INIT ====================
        window.onload = function () {
            initTailwind();
            renderTable(allData); // tampilkan data awal
        };

        function showAddModal() {
            document.getElementById('add-modal').classList.remove('hidden');
            document.getElementById('add-modal').classList.add('flex');
        }
    </script>
</body>

</html>