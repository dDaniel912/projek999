<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Tambah Produk</h1>

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

    <form action="{{ route('produk.store') }}" method="POST">

    @csrf
    <div>
        <label>Barcode</label>
        <input type="number" name="barcode" value="{{ old('barcode') }}">
    </div>
    <br>

    <div>
        <label for="">ID Produk</label>
        <input type="text" name="id_produk" value="{{ old('id_produk') }}">
    </div>
    
    <br>

    <div>
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}">
    </div>

    <br>

    <div>
        <label for="">Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori') }}">
    </div>

    <br>

    <div>
        <label for="">Harga Beli</label>
        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}">
    </div>

    <br>

    <div>
        <label for="">Harga Jual</label>
        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}">
    </div>

    <br>

    <div>
        <label for="">Jumlah</label>
        <input type="number" name="jumlah" value="{{ old('jumlah') }}">
    </div>

    <br>

    <button type="submit">
        Simpan
    </button>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
    </form>


    <a href="{{ route('test.') }}">
        Kembali
    </a>

</form>

</body>
</html>