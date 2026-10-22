<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Stok Barang - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stokopname.css') }}">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- SIDEBAR (persis seperti sebelumnya) -->
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

        <form action="{{ route('tambahmutasi.store') }}"></form>
        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Stok Opname</div>
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
            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <!-- FILTERS -->
                    <div class="card p-6 mb-8">
                        <div class="flex items-end gap-6">
                            <!-- Lokasi -->
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <div class="flex gap-3">
                                    <select id="lokasi-select"
                                        class="flex-1 bg-gray-50 border border-gray-300 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:border-2 focus:border-[#7B61FF]">
                                        <option value="">Pilih Lokasi</option>
                                        <option value="Rak A-3">Rak A-3</option>
                                        <option value="Rak B-5">Rak B-5</option>
                                        <option value="Rak C-1">Rak C-1</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kode Produk -->
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Produk</label>
                                <input id="kode-input" type="text" placeholder="Kode Produk" value="{{ old('') }}"
                                    class="w-full bg-gray-50 border border-gray-300 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:border-2 focus:border-[#7B61FF]">
                            </div>
                        </div>
                        <button onclick="applyFilter()"
                            class="px-8 bg-[#7B61FF] hover:bg-[#6A4AD9] text-white font-medium rounded-2xl transition-all">
                            Carissssssssss
                        </button>
                        <div class="flex items-center gap-4">
                            <div onclick="exportExcel()"
                                class="accent-btn px-6 py-2 rounded-2xl flex items-center gap-2 cursor-pointer shadow-md">
                                <i class="fas fa-file-excel text-lg"></i>
                                <span class="font-medium">Excel</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="px-6 py-5 border-b flex justify-between items-center">
                            <h3 class="font-semibold text-lg">Daftar Stok Barang</h3>
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
                                        <th class="text-left">No</th>
                                        <th class="text-left">Kode</th>
                                        <th class="text-left">Produk</th>
                                        <th class="text-left">Kategori</th>
                                        <th class="text-right">Total</th>
                                        <th class="text-left">Lokasi</th>
                                        <th class="text-left">Detail</th>
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

    <script>
        function initTailwind() {
        }
        let allData = [
            {
                no: "1",
                kode: "PROD-001",
                produk: "Vitamin C - 1000mg",
                kategori: "Vitamin",
                total: 245,
                lokasi: "Rak A-3",
                detail: "Detail"
            },
            {
                no: "2",
                kode: "PROD-002",
                produk: "Paracetamol 500mg",
                kategori: "Obat",
                total: 187,
                lokasi: "Rak B-5",
                detail: "Detail"
            },
            {
                no: "3",
                kode: "PROD-003",
                produk: "Obat Flu - Sirup",
                kategori: "Obat",
                total: 320,
                lokasi: "Rak C-1",
                detail: "Detail"
            }
        ];

        // ==================== RENDER TABLE ====================
        function renderTable(filteredData) {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-400">
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
                    <td class="font-medium">${item.no}</td>
                    <td class="font-medium">${item.kode}</td>
                    <td>${item.produk}</td>
                    <td class="capitalize">${item.kategori}</td>
                    <td class="text-right font-semibold">${item.total}</td>
                    <td>${item.lokasi}</td>
                    <td>
                        <button onclick="showDetail('${item.kode}')" 
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
            const selectedLokasi = document.getElementById('lokasi-select').value;
            const kodeInput = document.getElementById('kode-input').value.toLowerCase();

            let filtered = allData;

            if (selectedLokasi) {
                filtered = filtered.filter(item => item.lokasi === selectedLokasi);
            }

            if (kodeInput) {
                filtered = filtered.filter(item =>
                    item.kode.toLowerCase().includes(kodeInput) ||
                    item.produk.toLowerCase().includes(kodeInput)
                );
            }

            renderTable(filtered);
        }

        // ==================== EXPORT EXCEL ====================
        function exportExcel() {
            const table = document.getElementById('stok-table');
            const rows = table.querySelectorAll('tr');
            let csvContent = "No,Kode,Produk,Kategori,Total,Lokasi,Detail\n";

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
            link.setAttribute("download", "laporan-stok-barang.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // ==================== MODAL TAMBAH ====================
        let isModalOpen = false;

        function openModal() {
            document.getElementById('modal-tambah').classList.remove('hidden');
            document.getElementById('modal-tambah').classList.add('flex');
            isModalOpen = true;
            document.getElementById('form-tambah').reset();
        }

        function closeModal() {
            document.getElementById('modal-tambah').classList.add('hidden');
            document.getElementById('modal-tambah').classList.remove('flex');
            isModalOpen = false;
        }

        document.getElementById('form-tambah').addEventListener('submit', function (e) {
            e.preventDefault();

            const newItem = {
                no: (allData.length + 1).toString(),
                kode: document.getElementById('kode-produk').value,
                produk: document.getElementById('nama-produk').value,
                kategori: document.getElementById('kategori').value,
                total: parseInt(document.getElementById('jumlah').value),
                lokasi: document.getElementById('lokasi').value,
                detail: "Detail"
            };

            allData.push(newItem);
            renderTable(allData);
            closeModal();

            // Toast notifikasi
            showToast("Barang berhasil ditambahkan!");
        });

        function showToast(message) {
            // Simple toast (bisa diimprove)
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-6 right-6 bg-green-600 text-white px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3';
            toast.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // ==================== DETAIL (placeholder) ====================
        function showDetail(kode) {
            alert(`Detail stok untuk kode: ${kode}\n\n(Fitur ini akan dikembangkan di masa depan)`);
        }

        // ==================== INIT ====================
        window.onload = function () {
            initTailwind();
            renderTable(allData); // tampilkan data awal

            // Tambah button di header (dari gambar referensi)
            const header = document.querySelector('header');
            const addBtn = document.createElement('button');
            addBtn.className = 'flex items-center gap-2 bg-white text-[#1800AD] hover:bg-gray-50 border border-[#1800AD] px-6 py-2 rounded-2xl font-medium transition-colors';
            addBtn.innerHTML = `
                <i class="fas fa-plus"></i>
                <span>+ Tambah</span>
            `;
            addBtn.onclick = openModal;
            header.appendChild(addBtn);
        };
    </script>
</body>

</html>