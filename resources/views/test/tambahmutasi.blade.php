<?php
$date = date('Ymd');
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$random = substr(str_shuffle($chars), 0, 6);
$automatic_id = "MUT" . $date . "" . $random;
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
    <link rel="stylesheet" href="{{ asset('css/tambahmutasi.css') }}">
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

        <div class="flex-1 flex flex-col">
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

            <form action="{{ route('tambahmutasi.store') }}" method="POST">
                @csrf
                <main class="p-6 md:p-8">
                    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm p-6 md:p-8">

                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                            Formulir Mutasi
                        </h2>

                        @if(session('success'))
                            <div class="mb-5 rounded-xl bg-emerald-100 text-emerald-800 p-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-5 rounded-xl bg-red-100 text-red-800 p-4">
                                <p class="font-semibold mb-2">Data belum berhasil disimpan:</p>
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                            <div>
                                <label for="asal" class="block text-xs font-medium text-gray-500 mb-2">
                                    LOKASI ASAL
                                </label>
                                <select id="asal" name="asal_cabang" required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                    <option value="">Pilih lokasi asal...</option>
                                    @foreach(['1', '2', '3', '4'] as $lokasi)
                                        <option value="{{ $lokasi }}" @selected(old('asal_cabang') == $lokasi)>
                                            {{ $lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tujuan" class="block text-xs font-medium text-gray-500 mb-2">
                                    LOKASI TUJUAN
                                </label>
                                <select id="tujuan" name="tujuan_cabang" required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                    <option value="">Pilih lokasi tujuan...</option>
                                    @foreach(['1', '2', '3', '4'] as $lokasi)
                                        <option value="{{ $lokasi }}" @selected(old('tujuan_cabang') == $lokasi)>
                                            {{ $lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="petugas" class="block text-xs font-medium text-gray-500 mb-2">
                                PETUGAS
                            </label>
                            <select id="petugas" name="approved_by" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                <option value="">Pilih nama petugas...</option>
                                @foreach(['44', '11', '08', '9', '7', 'Bambang'] as $petugas)
                                    <option value="{{ $petugas }}" @selected(old('approved_by') == $petugas)>
                                        {{ $petugas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="catatan" class="block text-xs font-medium text-gray-500 mb-2">
                                CATATAN (OPSIONAL)
                            </label>
                            <textarea id="catatan" name="notes" rows="3" maxlength="100"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 resize-none"
                                placeholder="Masukkan catatan...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="bg-gray-50 rounded-2xl p-5 md:p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div>
                                    <label for="jumlah" class="block text-xs font-medium text-gray-500 mb-2">
                                        JUMLAH
                                    </label>
                                    <div class="flex border border-gray-300 rounded-xl overflow-hidden bg-white">
                                        <button type="button" onclick="changeQty(-1)"
                                            class="w-12 text-xl hover:bg-gray-100">−</button>
                                        <input id="jumlah" name="jumlah" type="number" min="1" max="25" required
                                            value="{{ old('jumlah', 1) }}"
                                            class="w-full min-w-0 text-center text-xl focus:outline-none">
                                        <button type="button" onclick="changeQty(1)"
                                            class="w-12 text-xl hover:bg-gray-100">+</button>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="barcode" class="block text-xs font-medium text-gray-500 mb-2">
                                        BARCODE
                                    </label>
                                    <input id="barcode" name="barcode" type="text" maxlength="100" required
                                        value="{{ old('barcode') }}" placeholder="Scan atau ketik barcode..."
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 font-mono">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <a href="{{ url()->previous() }}"
                                class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700">
                                Kembali
                            </a>

                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-7 py-3 rounded-xl">
                                PROSES MUTASI →
                            </button>
                        </div>

                    </div>
                </main>
            </form>

            {{-- <form action="{{ route('tambahmutasi.store') }}" method="POST">
                @csrf
                <main class="flex-1 p-8 overflow-auto bg-zinc-100">
                    <div class="max-w-3xl mx-auto">
                        <div class="bg-white rounded-3xl shadow-sm p-8">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-semibold text-gray-800">Formulir Mutasi</h2>
                                <div class="form-group">
                                    <label>Id Mutasi</label>
                                    <input type="text" name="id_mutasi" value="<?php echo $automatic_id; ?>" readonly>
                                </div>
                                <div id="toast"
                                    class="hidden fixed bottom-6 right-6 bg-emerald-600 text-white px-6 py-3 rounded-3xl shadow-2xl flex items-center gap-3">
                                    <span class="text-xl">✅</span>
                                    <span id="toast-text" class="font-medium"></span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-2">LOKASI ASAL</label>
                                    <select id="asal" name="asal_cabang_id" value="{{ old('asal_cabang_id') }}" required
                                        class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                        <option value="">Pilih Lokasi Asal...</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4 Kuning">4 Kuning</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-2">LOKASI TUJUAN</label>
                                    <select id="tujuan" name="tujuan_cabang_id" value="{{ old('tujuan_cabang_id') }}"
                                        class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                        <option value="">Pilih Lokasi Tujuan...</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-8">
                                <label class="block text-xs font-medium text-gray-500 mb-2">PETUGAS</label>
                                <select id="petugas" name="approved_by" value="{{ old('approved_by') }}"
                                    class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD]">
                                    <option value="">Pilih Nama Petugas...</option>
                                    <option value="Budi">6</option>
                                    <option value="Siti">1</option>
                                    <option value="Rina">2</option>
                                    <option value="Joko">3</option>
                                    <option value="Ani">4</option>
                                    <option value="Bambang">5</option>
                                </select>
                            </div>
                            <div class="mb-8">
                                <label class="block text-xs font-medium text-gray-500 mb-2" name="notes"
                                    value="{{ old('notes') }}">Catatan (Opsional)</label>
                                <textarea id="catatan" rows="2"
                                    class="form-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-sm outline-none focus:border-[#1800AD] resize-none"></textarea>
                            </div>

                            <div class="bg-gray-50 rounded-3xl p-8">
                                <div class="text-sm font-medium text-gray-500 mb-4">MUNCUL SETELAH LOKASI DAN PETUGAS
                                    DIISI
                                </div>

                                <div class="grid grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-2">JUMLAH</label>
                                        <div class="flex border border-gray-300 rounded-2xl overflow-hidden">
                                            <input id="jumlah" type="text" name="jumlah" value="{{ old('jumlah') }}"
                                                class="barcode-input flex-1 text-center font-mono text-2xl focus:outline-none bg-white">
                                        </div>
                                    </div>

                                    <div class="col-span-2">
                                        <label class="block text-xs font-medium text-gray-500 mb-2">BARCODE</label>
                                        <input id="barcode" type="barcode" name="barcode" value="{{ old('barcode') }}"
                                            placeholder="Scan atau ketik barcode..."
                                            class="barcode-input w-full border border-gray-300 rounded-2xl px-5 py-3 text-2xl font-mono focus:outline-none focus:border-[#1800AD]">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" onclick="prosesMutasi()"
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
        </div>
        </main>
        </form> --}}
    </div>
    </div>


    {{-- <div id="modalMutasi" class="fixed inset-0 z-50 hidden items-center justify-center
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
            <form action="{{ route('') }}" method="POST">
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
                    <button onclick="tutupModal()"
                        class="px-8 py-3 border border-zinc-300 rounded-2xl font-medium">Batal</button>
                    <button type="submit"
                        class="bg-[#1800AD] text-white px-8 py-3 rounded-2xl font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div> --}}

    <script>
        function changeQty(change) {
        const input = document.getElementById('jumlah');
        const current = parseInt(input.value) || 1;
        input.value = Math.max(1, Math.min(25, current + change));
    }
        // function bukaModal() {
        //     const modal = document.getElementById('modalMutasi');
        //     modal.classList.remove('hidden');
        //     modal.classList.add('flex');
        // }

        // function tutupModal() {
        //     const modal = document.getElementById('modalMutasi');
        //     modal.classList.add('hidden');
        //     modal.classList.remove('flex');
        // }


        // const petugasList = ["Budi", "Siti", "Rina", "Joko", "Ani", "Bambang"];

        // function renderPetugas() {
        //     const select = document.getElementById('petugas');
        //     select.innerHTML = `<option value="">Pilih Nama Petugas...</option>`;
        //     petugasList.forEach(p => {
        //         const opt = document.createElement('option');
        //         opt.value = p;
        //         opt.textContent = p;
        //         select.appendChild(opt);
        //     });
        // }

        // function changeQty(delta) {
        //     const input = document.getElementById('jumlah');
        //     let current = parseInt(input.value) || 0;
        //     current += delta;
        //     if (current < 0) current = 0;
        //     input.value = current;
        // }

        // function prosesMutasi() {
        //     const asal = document.getElementById('asal').value;
        //     const tujuan = document.getElementById('tujuan').value;
        //     const petugas = document.getElementById('petugas').value;
        //     const jumlah = document.getElementById('jumlah').value;
        //     const barcode = document.getElementById('barcode').value;
        //     const catatan = document.getElementById('catatan').value;

        //     if (!asal || !tujuan || !petugas || !jumlah || !barcode) {
        //         showToast('Silakan lengkapi semua field!', 'error');
        //         return;
        //     }

        //     const btn = document.querySelector('.proses-btn');
        //     const originalText = btn.innerHTML;
        //     btn.innerHTML = `
        //         <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        //             <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        //             <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        //         </svg>
        //         Memproses...
        //     `;
        //     btn.disabled = true;

        //     setTimeout(() => {
        //         showToast(`Mutasi berhasil diproses! (Jumlah: ${jumlah} pcs)`, 'success');

        //         document.getElementById('asal').value = '';
        //         document.getElementById('tujuan').value = '';
        //         document.getElementById('petugas').value = '';
        //         document.getElementById('jumlah').value = '1';
        //         document.getElementById('barcode').value = '';
        //         document.getElementById('catatan').value = '';

        //         btn.innerHTML = originalText;
        //         btn.disabled = false;
        //     }, 1200);
        // }

        // function showToast(message, type = 'success') {
        //     const toast = document.getElementById('toast');
        //     const toastText = document.getElementById('toast-text');
        //     toastText.textContent = message;

        //     if (type === 'error') {
        //         toast.classList.remove('bg-emerald-600');
        //         toast.classList.add('bg-red-600');
        //     } else {
        //         toast.classList.remove('bg-red-600');
        //         toast.classList.add('bg-emerald-600');
        //     }

        //     toast.classList.remove('hidden');
        //     toast.classList.add('success-toast');

        //     setTimeout(() => {
        //         toast.classList.add('hidden');
        //     }, 2800);
        // }

        // function resetForm() {
        //     document.getElementById('asal').value = '';
        //     document.getElementById('tujuan').value = '';
        //     document.getElementById('petugas').value = '';
        //     document.getElementById('jumlah').value = '1';
        //     document.getElementById('barcode').value = '';
        //     document.getElementById('catatan').value = '';
        // }

        // window.onload = function () {
        //     renderPetugas();
        //     console.log('%c✅ Tambah Mutasi Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
        // };
    </script>
</body>

</html>