<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mutasi • Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Poppins:wght@600&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tambahstok.css') }}">
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

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- TOPBAR -->
            <header class="h-16 bg-white border-b border-zinc-200 px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="text-2xl font-semibold text-[#1800AD]">Tambah Mutasi</div>
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

            <!-- CONTENT -->
            <main class="flex-1 p-8 overflow-auto bg-zinc-100">
                <div class="max-w-3xl mx-auto">
                    <!-- Form -->
                    <div class="bg-white rounded-3xl shadow-sm p-8">
                        <!-- Header Form -->
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800">Formulir Mutasi</h2>
                            <button onclick="resetForm()"
                                class="px-6 py-2 text-sm border border-gray-300 rounded-2xl hover:bg-gray-50">
                                Reset
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <!-- Lokasi Asal -->
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-2">LOKASI ASAL</label>
                                <select id="asal"
                                    class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                    <option value="">Pilih Lokasi Asal...</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Gedong Kuning">Gedong Kuning</option>
                                    <option value="Sleman">Sleman</option>
                                    <option value="Indocard">Indocard</option>
                                    <option value="Bantul">Bantul</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-2">LOKASI TUJUAN</label>
                                <select id="tujuan"
                                    class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                    <option value="">Pilih Lokasi Tujuan...</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Gedong Kuning">Gedong Kuning</option>
                                    <option value="Sleman">Sleman</option>
                                    <option value="Indocard">Indocard</option>
                                    <option value="Bantul">Bantul</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-medium text-gray-500 mb-2">PETUGAS</label>
                            <select id="petugas"
                                class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                <option value="">Pilih Nama Petugas...</option>
                                <option value="Budi">Budi</option>
                                <option value="Siti">Siti</option>
                                <option value="Rina">Rina</option>
                                <option value="Joko">Joko</option>
                                <option value="Ani">Ani</option>
                                <option value="Bambang">Bambang</option>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-medium text-gray-500 mb-2">Catatan (Opsional)</label>
                            <textarea id="catatan" rows="2"
                                class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD] resize-none"></textarea>
                        </div>

                        <div class="bg-gray-50 rounded-3xl p-8">
                            <div class="text-sm font-medium text-gray-500 mb-4">MUNCUL SETELAH LOKASI DAN PETUGAS DIISI
                            </div>

                            <div class="grid grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-2">JUMLAH</label>
                                    <div class="flex border border-gray-300 rounded-2xl overflow-hidden">
                                        <button onclick="changeQty(-1)"
                                            class="w-12 flex items-center justify-center text-xl hover:bg-gray-100">-</button>
                                        <input id="jumlah" type="text" value="1"
                                            class="barcode-input flex-1 text-center font-mono text-2xl focus:outline-none bg-white">
                                        <button onclick="changeQty(1)"
                                            class="w-12 flex items-center justify-center text-xl hover:bg-gray-100">+</button>
                                    </div>
                                </div>

                                <!-- Barcode -->
                                <div class="col-span-2">
                                    <label class="block text-xs font-medium text-gray-500 mb-2">BARCODE</label>
                                    <input id="barcode" type="text" placeholder="Scan atau ketik barcode..."
                                        class="barcode-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-2xl font-mono focus:outline-none focus:border-[#1800AD]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button onclick="prosesMutasi()"
                            class="proses-btn bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-10 py-4 rounded-3xl flex items-center gap-3 text-lg shadow-lg">
                            <span>PROSES MUTASI</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M14 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div id="toast"
        class="hidden fixed bottom-6 right-6 bg-emerald-600 text-white px-6 py-3 rounded-3xl shadow-2xl flex items-center gap-3">
        <span class="text-xl">✅</span>
        <span id="toast-text" class="font-medium"></span>
    </div>

    <script>
        // Data dummy untuk pencarian
        const petugasList = ["Budi", "Siti", "Rina", "Joko", "Ani", "Bambang"];

        // Render Petugas
        function renderPetugas() {
            const select = document.getElementById('petugas');
            select.innerHTML = `<option value="">Pilih Nama Petugas...</option>`;
            petugasList.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p;
                opt.textContent = p;
                select.appendChild(opt);
            });
        }

        // Change Qty
        function changeQty(delta) {
            const input = document.getElementById('jumlah');
            let current = parseInt(input.value) || 0;
            current += delta;
            if (current < 0) current = 0;
            input.value = current;
        }

        // Proses Mutasi
        function prosesMutasi() {
            const asal = document.getElementById('asal').value;
            const tujuan = document.getElementById('tujuan').value;
            const petugas = document.getElementById('petugas').value;
            const jumlah = document.getElementById('jumlah').value;
            const barcode = document.getElementById('barcode').value;
            const catatan = document.getElementById('catatan').value;

            // Validasi
            if (!asal || !tujuan || !petugas || !jumlah || !barcode) {
                showToast('Silakan lengkapi semua field!', 'error');
                return;
            }

            // Tampilkan efek loading
            const btn = document.querySelector('.proses-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Memproses...
            `;
            btn.disabled = true;

            // Simulasi proses
            setTimeout(() => {
                showToast(`Mutasi berhasil diproses! (Jumlah: ${jumlah} pcs)`, 'success');

                // Reset form
                document.getElementById('asal').value = '';
                document.getElementById('tujuan').value = '';
                document.getElementById('petugas').value = '';
                document.getElementById('jumlah').value = '1';
                document.getElementById('barcode').value = '';
                document.getElementById('catatan').value = '';

                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1200);
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastText = document.getElementById('toast-text');
            toastText.textContent = message;

            if (type === 'error') {
                toast.classList.remove('bg-emerald-600');
                toast.classList.add('bg-red-600');
            } else {
                toast.classList.remove('bg-red-600');
                toast.classList.add('bg-emerald-600');
            }

            toast.classList.remove('hidden');
            toast.classList.add('success-toast');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2800);
        }

        function resetForm() {
            document.getElementById('asal').value = '';
            document.getElementById('tujuan').value = '';
            document.getElementById('petugas').value = '';
            document.getElementById('jumlah').value = '1';
            document.getElementById('barcode').value = '';
            document.getElementById('catatan').value = '';
        }

        // Inisialisasi
        window.onload = function () {
            renderPetugas();
            console.log('%c✅ Tambah Mutasi Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
        };
    </script>
</body>

</html>