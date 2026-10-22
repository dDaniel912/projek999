<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Edit Produk</h1>

    @if ($errors->any())
    <div>
        <strong>Terjadi Kesalahan</strong>
        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error }}</li>
                @endforeach
        </ul>
    </div>
@endif

@if(session("success"))
    <p style="color: green;">
        {{ session('success')}}
        </p>
        @endif
        <form action="{{ route('produk.update', $produk->barcode) }}" method="POST" >
            @csrf
            @method('PUT')
    <p><Label>Barcode</Label><br/>
        <input type="number" name="barcode" value="{{ $produk->barcode }}" readonly>
    </p>

    <p>
        <label> ID Produk</label><br>

        <input type="text" name="id_produk" value="{{ $produk->id_produk }}"> 
    </p>

    <p> <label>Nama Produk</label><br>
        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}">
    </p>

    <p>
        <label>Kategori</label><br>

        <input type="text" name="kategori" value="{{ $produk->kategori }}">
    </p>

    <p>
        <label>Harga Beli</label><br>

        <input type="number" name="harga_beli" value="{{$produk->harga_beli}}">

    </p>

    <p>
        <label>Harga Jual</label><br>
    <input type="number" name="harga_jual" value="{{ $produk->harga_jual }}">
        
    </p>

    <p>
        <label>Jumlah</label><br>
        <input type="number" name="jumlah" value="{{ $produk->jumlah }}">
    </p>

    <br>

    <button type="submit">Update</button>

    <a href="{{ route('produk.index') }}">
        Kembali
    </a>

</form>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
    </form>

</body>
</html>