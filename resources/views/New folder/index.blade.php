<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Data Produk</h1>
    
    <a href="{{route('produk.create')}}">
        Tambah Produk
    </a>

    @if(session('success'))
    <p style="color: green;">
        {{session('success')}}</p>
    @endif

    <table border="1" cellpadding="10">
        <thread>
            <try>
                <th>Barcode</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thread>

    <tbody>
        @foreach($produk as $item)
        <tr>
            <td>{{ $item->barcode }}</td>
            <td>{{ $item->id_produk}}</td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->kategori }}</td>
            <td>{{ $item->harga_beli }}</td>
            <td>{{ $item->harga_jual }}</td>
            <td>{{ $item->jumlah }}</td>

            <td>
                <a href="{{ route('produk.edit', $item->barcode) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('produk.destroy', $item->barcode) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Apakah Anda yakin inging menghapus produk ini?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Hapus
                        </button>
                    </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>