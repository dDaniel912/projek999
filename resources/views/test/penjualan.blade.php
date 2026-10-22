    <?php
    session_start();
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PENJUALAN • Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/penjualan.css') }}">
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
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="flex items-center gap-3 px-4 py-2 w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
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
                        <div class="text-2xl font-semibold text-[#1800AD]">PENJUALAN</div>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <button onclick="alert('Notifikasi')" 
                                class="relative w-10 h-10 flex items-center justify-center text-zinc-500 hover:text-[#1800AD] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9-5.197V8c0 .668-.149 1.297-.408 1.886L13 11v5.158c0 .558-.214 1.098-.595 1.491L19 17z" /></svg>
                        </button>

                        <div class="relative">
                        <button
                            type="button"
                            onclick="toggleProfileMenu()"
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

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-3 w-56
                                    bg-white rounded-xl shadow-lg
                                    border border-gray-100 z-50">
                            <!-- Profil -->
                            <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 px-4 py-3
                                    hover:bg-gray-100">
                                <span>👤</span>
                                <span>
                                    Lihat Profil
                                </span>
                            </a>
                            <form action="{{ route('logout') }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-3
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
                </header>
                
                <!-- CONTENT -->
                <main class="flex-1 p-8 overflow-auto bg-zinc-100">
                    <!-- FILTER BAR -->
                    <div class="bg-white p-6 rounded-3xl shadow-sm mb-6">
                        <div class="grid grid-cols-5 gap-4">
                            <!-- Dari -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-500 mb-1">Dari</label>
                                <input type="date" id="dari" 
                                    class="w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-4 py-3 text-sm outline-none">
                            </div>
                            <!-- Sampai -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-500 mb-1">Sampai</label>
                                <input type="date" id="sampai" 
                                    class="w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-4 py-3 text-sm outline-none">
                            </div>
                            <!-- Lokasi -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-500 mb-1">Lokasi</label>
                                <select id="lokasi" 
                                        class="w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-4 py-3 text-sm outline-none bg-white">
                                    <option value="">Semua Lokasi</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Surabaya">Surabaya</option>
                                </select>
                            </div>
                            <!-- Kategori -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-500 mb-1">Kategori</label>
                                <select id="kategori" 
                                        class="w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-4 py-3 text-sm outline-none bg-white">
                                    <option value="">Semua Kategori</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Pakaian">Pakaian</option>
                                </select>
                            </div>
                            <!-- Karyawan -->
                            <div>
                                <label class="block text-xs font-medium text-zinc-500 mb-1">Karyawan</label>
                                <select id="karyawan" 
                                        class="w-full border border-zinc-300 focus:border-[#1800AD] rounded-2xl px-4 py-3 text-sm outline-none bg-white">
                                    <option value="">Semua Karyawan</option>
                                    <option value="Budi">Budi</option>
                                    <option value="Siti">Siti</option>
                                    <option value="Rina">Rina</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- STATISTICS CARDS -->
                    <div class="grid grid-cols-4 gap-6 mb-8">
                        <!-- Total Omset -->
                        <div class="card bg-white p-8 rounded-3xl">
                            <div class="text-xs text-zinc-500">Total Omset</div>
                            <div class="text-4xl font-semibold text-[#1800AD] mt-2">Rp 500.000.000.000</div>
                            <div class="text-xs text-emerald-500 mt-3">• +12% dari bulan lalu</div>
                        </div>
                        
                        <!-- Total Transaksi -->
                        <div class="card bg-white p-8 rounded-3xl">
                            <div class="text-xs text-zinc-500">Total Transaksi</div>
                            <div class="text-4xl font-semibold text-[#1800AD] mt-2">30.000</div>
                            <div class="text-xs text-emerald-500 mt-3">• +5% dari bulan lalu</div>
                        </div>
                        
                        <!-- Laba Bersih -->
                        <div class="card bg-white p-8 rounded-3xl">
                            <div class="text-xs text-zinc-500">Laba Bersih</div>
                            <div class="text-4xl font-semibold text-[#1800AD] mt-2">Rp 300.000.000.000</div>
                            <div class="text-xs text-emerald-500 mt-3">• +8% dari bulan lalu</div>
                        </div>
                        
                        <!-- Potongan Laba Retur -->
                        <div class="card bg-white p-8 rounded-3xl">
                            <div class="text-xs text-zinc-500">Potongan Laba Retur</div>
                            <div class="text-4xl font-semibold text-[#1800AD] mt-2">Rp 200.000.000.000</div>
                            <div class="text-xs text-red-500 mt-3">• -3% dari bulan lalu</div>
                        </div>
                    </div>
                    
                    <!-- TABLE & RIGHT PANEL -->
                    <div class="grid grid-cols-12 gap-6">
                        <!-- Omset per Tanggal -->
                        <div class="col-span-8 bg-white rounded-3xl p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-semibold">Omset per Tanggal</h3>
                                <button onclick="alert('Export CSV')" 
                                        class="text-xs bg-[#1800AD] text-white px-5 py-2 rounded-2xl hover:bg-[#120080] transition-colors">
                                    Export CSV
                                </button>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="py-4 px-6 text-left font-medium text-zinc-500">Tanggal</th>
                                            <th class="py-4 px-6 text-left font-medium text-zinc-500">Omset</th>
                                            <th class="py-4 px-6 text-left font-medium text-zinc-500">TRX</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body" class="text-zinc-600">
                                        <!-- JS akan isi tabel -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Omset per Kategori -->
                        <div class="col-span-4 bg-white rounded-3xl p-6">
                            <h3 class="text-xl font-semibold mb-6">Omset per Kategori</h3>
                            <div class="space-y-6">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">Makanan</div>
                                        <div class="text-xs text-zinc-500">12.450</div>
                                    </div>
                                    <div class="w-32 h-2 bg-zinc-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#7B61FF]" style="width: 42%"></div>
                                    </div>
                                    <div class="font-semibold">Rp 210.000.000</div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">Minuman</div>
                                        <div class="text-xs text-zinc-500">8.920</div>
                                    </div>
                                    <div class="w-32 h-2 bg-zinc-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#7B61FF]" style="width: 28%"></div>
                                    </div>
                                    <div class="font-semibold">Rp 140.000.000</div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">Pakaian</div>
                                        <div class="text-xs text-zinc-500">4.110</div>
                                    </div>
                                    <div class="w-32 h-2 bg-zinc-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#7B61FF]" style="width: 18%"></div>
                                    </div>
                                    <div class="font-semibold">Rp 80.000.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- EMPTY RIGHT SECTION (seperti gambar) -->
                    <div class="grid grid-cols-12 gap-6 mt-6">
                        <!-- Kiri kosong -->
                        <div class="col-span-8 bg-white rounded-3xl p-6">
                            <div class="h-96 flex items-center justify-center text-zinc-300">
                                <div class="text-center">
                                    <span class="text-6xl">📊</span>
                                    <p class="mt-4 text-lg">Pilih filter untuk melihat data</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kanan kosong -->
                        <div class="col-span-4 bg-white rounded-3xl p-6">
                            <div class="h-96 flex items-center justify-center text-zinc-300">
                                <div class="text-center">
                                    <span class="text-6xl">📊</span>
                                    <p class="mt-4 text-lg">Pilih filter untuk melihat data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
    </html>