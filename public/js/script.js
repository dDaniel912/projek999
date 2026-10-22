function activateButton(el) {
    document.querySelectorAll('.menu-card').forEach(card => {
        card.style.transform = 'translateY(-8px) scale(1.03)';
        card.style.boxShadow = '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)';
    });

    el.style.transform = 'scale(0.96)';
    el.style.boxShadow = '0 25px 50px -12px rgb(0 0 0 / 0.25)';

    setTimeout(() => {
        el.style.transform = 'translateY(-8px) scale(1.03)';
        el.style.boxShadow = '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)';
    }, 180);

    console.log('Button activated:', el.querySelector('h3').textContent);
}

document.addEventListener('keydown', function (e) {
    if (e.key.toLowerCase() === 's') {
        const setUpCard = document.querySelector('.menu-card');
        if (setUpCard) {
            activateButton(setUpCard);
            setTimeout(() => {
                alert('🎉 Tombol SET UP diaktifkan (klik lain untuk reset)');
            }, 250);
        }
    }
});

console.log('%c✅ Dashboard UI PHP siap pakai! (Tailwind + interaksi)', 'color:#1800AD; font-family:monospace');


const tableData = [
    { date: "01 Okt 2026", omset: "Rp 45.200.000", trx: "1.245" },
    { date: "02 Okt 2026", omset: "Rp 52.800.000", trx: "1.380" },
    { date: "03 Okt 2026", omset: "Rp 38.900.000", trx: "980" },
    { date: "04 Okt 2026", omset: "Rp 61.500.000", trx: "1.620" },
    { date: "05 Okt 2026", omset: "Rp 78.900.000", trx: "2.100" }
];

function renderTable() {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = '';

    tableData.forEach(row => {
        const tr = document.createElement('tr');
        tr.className = 'table-row border-b hover:bg-zinc-50';
        tr.innerHTML = `
                    <td class="py-4 px-6">${row.date}</td>
                    <td class="py-4 px-6 font-medium">${row.omset}</td>
                    <td class="py-4 px-6 text-right">${row.trx}</td>
                `;
        tbody.appendChild(tr);
    });
}

window.onload = function () {
    renderTable();

    console.log('%c✅ Penjualan Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
};

function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');

    menu.classList.toggle('hidden');
}

document.addEventListener('click', function (event) {

    const menu = document.getElementById('profileMenu');
    const button = event.target.closest('button');

    if (!event.target.closest('#profileMenu') &&
        !event.target.closest('.relative button')) {

        menu.classList.add('hidden');
    }

});

function tampilkanTanggal() {
    const sekarang = new Date();

    const tanggalIndonesia = new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    }).format(sekarang);

    const elemenTanggal = document.getElementById('tanggal-hari');

    if (elemenTanggal) {
        elemenTanggal.textContent = tanggalIndonesia;
    }
}

tampilkanTanggal();
setInterval(tampilkanTanggal, 60000);

let currentPage = 1;
const pageSize = 10;
let allData = [
    { kode: "SRVB 01", produk: "BATRE MEDIUM 150", stok: 12, hpp: 350000, nilai: 4200000 },
    { kode: "SRVB 02", produk: "BATRE MEDIUM 170", stok: 5, hpp: 400000, nilai: 2000000 },
    { kode: "SRVB 03", produk: "BATRE MEDIUM 180", stok: 8, hpp: 380000, nilai: 3040000 },
    { kode: "SRVB 04", produk: "BATRE MEDIUM 190", stok: 3, hpp: 450000, nilai: 1350000 },
    { kode: "SRVB 05", produk: "BATRE MEDIUM 200", stok: 15, hpp: 320000, nilai: 4800000 },
    { kode: "SRVB 06", produk: "BATRE MEDIUM 210", stok: 7, hpp: 410000, nilai: 2870000 },
    { kode: "SRVB 07", produk: "BATRE MEDIUM 220", stok: 9, hpp: 390000, nilai: 3510000 },
    { kode: "SRVB 08", produk: "BATRE MEDIUM 230", stok: 4, hpp: 460000, nilai: 1840000 },
    { kode: "SRVB 09", produk: "BATRE MEDIUM 240", stok: 11, hpp: 330000, nilai: 3630000 },
    { kode: "SRVB 10", produk: "BATRE MEDIUM 250", stok: 6, hpp: 430000, nilai: 2580000 },
    { kode: "SRVB 11", produk: "BATRE MEDIUM 260", stok: 14, hpp: 310000, nilai: 4340000 },
    { kode: "SRVB 12", produk: "BATRE MEDIUM 270", stok: 2, hpp: 480000, nilai: 960000 },
    { kode: "SRVB 13", produk: "BATRE MEDIUM 280", stok: 10, hpp: 340000, nilai: 3400000 },
    { kode: "SRVB 14", produk: "BATRE MEDIUM 290", stok: 5, hpp: 420000, nilai: 2100000 },
    { kode: "SRVB 15", produk: "BATRE MEDIUM 300", stok: 8, hpp: 370000, nilai: 2960000 },
];

function renderTable() {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = '';

    const start = (currentPage - 1) * pageSize;
    const pageData = allData.slice(start, start + pageSize);

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="py-16 text-center text-zinc-400">
                            Tidak ada data persediaan stok
                        </td>
                    </tr>`;
        return;
    }

    pageData.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'border-b hover:bg-zinc-50 transition-colors';
        row.innerHTML = `
                    <td class="py-5 px-6 font-medium">${item.kode}</td>
                    <td class="py-5 px-6">${item.produk}</td>
                    <td class="py-5 px-6 text-center font-medium">${item.stok}</td>
                    <td class="py-5 px-6">Rp ${item.hpp.toLocaleString('id-ID')}</td>
                    <td class="py-5 px-6 font-medium">Rp ${item.nilai.toLocaleString('id-ID')}</td>
                `;
        tbody.appendChild(row);
    });
}

function calculateSummary() {
    let totalStok = 0;
    let totalHPP = 0;

    allData.forEach(item => {
        totalStok += item.stok;
        totalHPP += item.stok * item.hpp;
    });

    document.getElementById('total-stok').textContent = totalStok;
    document.getElementById('total-hpp').textContent = 'Rp ' + totalHPP.toLocaleString('id-ID');
}

function loadTable() {
    const lokasiFilter = document.getElementById('lokasi').value;
    const produkFilter = document.getElementById('produk').value.toLowerCase();

    if (!lokasiFilter && !produkFilter) {
        renderTable();
        calculateSummary();
        return;
    }

    const filteredData = allData.filter(item => {
        const matchLokasi = !lokasiFilter || item.kode.includes(lokasiFilter);
        const matchProduk = !produkFilter ||
            item.produk.toLowerCase().includes(produkFilter) ||
            item.kode.toLowerCase().includes(produkFilter);
        return matchLokasi && matchProduk;
    });

    allData = filteredData;
    currentPage = 1;
    renderTable();
    calculateSummary();
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        renderTable();
    }
}

function nextPage() {
    if (currentPage < Math.ceil(allData.length / pageSize)) {
        currentPage++;
        renderTable();
    }
}

function exportExcel() {
    const summaryStok = document.getElementById('total-stok').textContent;
    const summaryHPP = document.getElementById('total-hpp').textContent;

    let csvContent = "Kode,Produk,Stok,HPP,Nilai\n";

    allData.forEach(item => {
        csvContent += `${item.kode},"${item.produk}",${item.stok},${item.hpp},${item.nilai}\n`;
    });

    csvContent += `\nTotal Stok,${summaryStok},,\n`;
    csvContent += `Total HPP,${summaryHPP}\n`;

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "persediaan_stok.csv";
    link.click();
}

window.onload = function () {
    renderTable();
    calculateSummary();
    console.log('%c✅ Persediaan Stok Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
};

(function () {
    var input = document.getElementById('password');
    var btn = document.getElementById('toggle-password');
    var open = document.getElementById('eye-open');
    var off = document.getElementById('eye-off');
    if (!btn || !input) return;
    btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        open.style.display = show ? 'none' : 'block';
        off.style.display = show ? 'block' : 'none';
        btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
    });
})();

let currentFilter = "";

function renderTable(filteredProducts) {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = '';

    filteredProducts.forEach(product => {
        const row = document.createElement('tr');
        row.className = 'border-b hover:bg-zinc-50 transition-colors';
        row.innerHTML = `
                    <td class="py-5 px-6">${product.nama}</td>
                    <td class="py-5 px-6">${product.kode}</td>
                    <td class="py-5 px-6">${product.kategori}</td>
                    <td class="py-5 px-6 text-center">${product.jumlah}</td>
                    <td class="py-5 px-6">Rp ${product.harga.toLocaleString('id-ID')}</td>
                    <td class="py-5 px-6">Rp ${product.hpp.toLocaleString('id-ID')}</td>
                    <td class="py-5 px-6">
                        <span class="px-4 py-1 rounded-full text-xs font-medium ${product.status === 'Tersedia' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600'}">
                            ${product.status}
                        </span>
                    </td>
                    <td class="py-5 px-6">
                        <button onclick="editProduct(${product.id})" class="text-[#1800AD] hover:underline mr-4">Edit</button>
                        <button onclick="deleteProduct(${product.id})" class="text-red-500 hover:underline">Hapus</button>
                    </td>
                `;
        tbody.appendChild(row);
    });
}

function filterTable() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const categoryFilter = document.getElementById('filter-select').value;

    let filtered = products;

    if (searchTerm) {
        filtered = filtered.filter(p =>
            p.nama.toLowerCase().includes(searchTerm) ||
            p.kode.toLowerCase().includes(searchTerm)
        );
    }

    if (categoryFilter) {
        filtered = filtered.filter(p => p.kategori === categoryFilter);
    }

    renderTable(filtered);
}

function showAddModal() {
    document.getElementById('add-modal').classList.remove('hidden');
    document.getElementById('add-modal').classList.add('flex');
}

function hideAddModal() {
    document.getElementById('add-modal').classList.add('hidden');
    document.getElementById('add-modal').classList.remove('flex');
}

function saveProduct() {
    const newProduct = {
        id: Date.now(),
        nama: document.getElementById('modal-nama').value || "Produk Baru",
        kode: document.getElementById('modal-kode').value || `PROD-${Date.now().toString().slice(-4)}`,
        kategori: document.getElementById('modal-kategori').value || "Elektronik",
        jumlah: parseInt(document.getElementById('modal-jumlah').value) || 0,
        harga: parseInt(document.getElementById('modal-harga').value) || 0,
        hpp: parseInt(document.getElementById('modal-hpp').value) || 0,
        status: document.getElementById('modal-status').value
    };
    if (
        !namaEl || !kodeEl || !kategoriEl ||
        !jumlahEl || !hargaEl || !hppEl || !statusEl
    ) {
        console.error('Input modal tidak ditemukan. Periksa ID HTML.');
        alert('Ada input yang belum terhubung dengan JavaScript.');
        return;
    }

    const nama = namaEl.value.trim();
    const kode = kodeEl.value.trim();

    if (!nama || !kode) {
        alert('Nama produk dan kode produk wajib diisi!');
        return;
    }

    // Pastikan array products tersedia
    if (!Array.isArray(products)) {
        console.error('Variabel products belum didefinisikan.');
        alert('Data produk belum siap. Periksa file JavaScript.');
        return;
    }

    products.push(newProduct);
    hideAddModal();
    filterTable();

    alert('Produk berhasil ditambahkan!');
}
// products.push(newProduct);
// hideAddModal();
// filterTable();
// alert('Produk berhasil ditambahkan!');
// }

function editProduct(id) {
    alert('Edit produk ' + id + ' (fitur akan dikembangkan)');
}

function deleteProduct(id) {
    if (confirm('Hapus produk ini?')) {
        products = products.filter(p => p.id !== id);
        filterTable();
    }
}

// Inisialisasi
window.onload = function () {
    renderTable(products);
    console.log('%c✅ Data Stok Barang Dashboard PHP siap pakai!', 'color:#1800AD; font-family:monospace');
};

async function updateStatistik() {
    try {
        const response = await fetch('/produk/statistik', {
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Gagal mengambil statistik');
        }

        const data = await response.json();

        document.getElementById('jumlah-barang').textContent =
            Number(data.jumlah_barang).toLocaleString('id-ID');

        document.getElementById('barang-masuk').textContent =
            '+' + Number(data.barang_masuk).toLocaleString('id-ID');

        document.getElementById('barang-keluar').textContent =
            '+' + Number(data.barang_keluar).toLocaleString('id-ID');

    } catch (error) {
        console.error('Gagal memperbarui statistik:', error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    updateStatistik();

    setInterval(updateStatistik, 3000);
});

const searchInput = document.getElementById('search-input');
const resultList = document.getElementById('result-list');

searchInput.addEventListener('input', function () {
    let keyword = this.value.trim();

    if (keyword.length < 1) {
        resultList.style.display = 'none';
        return;
    }


    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !resultList.contains(e.target)) {
            resultList.style.display = 'none';
        }
    });


   