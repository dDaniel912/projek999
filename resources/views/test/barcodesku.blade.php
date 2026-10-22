<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode & SKU - ElectricBlue Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/barcodesku.css') }}">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
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
                © 2026 ElectricBlue
            </div>
        </div>


        <div class="flex-1 flex flex-col">
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

            <!-- CONTENT AREA -->
            <div class="flex-1 p-8 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <!-- FILTERS -->
                    <div class="card p-6 mb-8">
                        <div class="flex items-end gap-6">
                            <!-- Barcode -->
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
                                <div class="flex gap-3">
                                    <input id="barcode-input" type="text" placeholder="Cari barcode..."
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
                            <h3 class="font-semibold text-lg">Daftar Barcode & SKU</h3>
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
                                        <th class="text-left">Barcode</th>
                                        <th class="text-left">SKU</th>
                                        <th class="text-left">Nama Produk</th>
                                        <th class="text-left">Kategori</th>
                                        <th class="text-left">Lokasi</th>
                                        <th class="text-right">Qty</th>
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
        // ==================== TAILWIND INIT ====================
        function initTailwind() {
            // Tailwind sudah di-load via CDN
        }

        // ==================== DATA DUMMY (bisa diganti dengan PHP dari database) ====================
        let allData = [
            {
                barcode: "1234567890123",
                sku: "SKU-001",
                namaProduk: "Vitamin C - 1000mg",
                kategori: "Vitamin",
                lokasi: "Rak A-3",
                qty: 245
            },
            {
                barcode: "9876543210987",
                sku: "SKU-002",
                namaProduk: "Paracetamol 500mg",
                kategori: "Obat",
                lokasi: "Rak B-5",
                qty: 187
            },
            {
                barcode: "4567891234567",
                sku: "SKU-003",
                namaProduk: "Obat Flu - Sirup",
                kategori: "Obat",
                lokasi: "Rak C-1",
                qty: 320
            }
        ];

        // ==================== RENDER TABLE ====================
        function renderTable(filteredData) {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-400">
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
                    <td class="font-mono text-xs">${item.barcode}</td>
                    <td class="font-medium">${item.sku}</td>
                    <td>${item.namaProduk}</td>
                    <td class="capitalize">${item.kategori}</td>
                    <td>${item.lokasi}</td>
                    <td class="text-right font-semibold">${item.qty}</td>
                `;
                tbody.appendChild(row);
            });
        }

        // ==================== FILTER + CARI ====================
        function applyFilter() {
            const barcodeInput = document.getElementById('barcode-input').value.toLowerCase();
            let filtered = allData;

            if (barcodeInput) {
                filtered = allData.filter(item =>
                    item.barcode.toLowerCase().includes(barcodeInput) ||
                    item.sku.toLowerCase().includes(barcodeInput) ||
                    item.namaProduk.toLowerCase().includes(barcodeInput)
                );
            }

            renderTable(filtered);
        }

        // ==================== EXPORT EXCEL ====================
        function exportExcel() {
            const table = document.getElementById('stok-table');
            const rows = table.querySelectorAll('tr');
            let csvContent = "Barcode,SKU,Nama Produk,Kategori,Lokasi,Qty\n";

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
            link.setAttribute("download", "laporan-barcode-sku.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // ==================== INIT ====================
        window.onload = function () {
            initTailwind();
            renderTable(allData); // tampilkan data awal
        };
    </script>
</body>

</html>