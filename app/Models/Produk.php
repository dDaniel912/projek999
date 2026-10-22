<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Produk extends Model
{
    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_produk',
        'kode_produk',
        'barcode',
        'nama_produk',
        'id_kategori',
        'nama_kategori',
        'merk_produk',
        'unit',
        'cost_price',
        'selling_price',
        'deskripsi',
        'is_active', ];

    public function stok()
    {
        return $this->hasMany(
            Stok::class,
            'barcode',
            'barcode'
        );

        return $this->hasMany(
            Stok::class, 
            'id_produk', 
            'id_produk'
        );
    }
    

    public function detailTransaksi()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'barcode',
            'barcode'
        );
    }

    private $koneksi;

    public function __construct()
    {
        global $koneksi;
        $this->koneksi = $koneksi;
    }

}
    // public function kategori()
    // {
    //     return $this->belongsTo(
    //         Kategori::class,
    //         'id_kategori',
    //         'id_kategori'
    //     );
    // }

    // public function getAll()
    // {
    //     $sql = 'SELECT produk.*,
    //                    kategori.nama_kategori
    //             FROM produk
    //             LEFT JOIN kategori
    //                 ON produk.id_kategori = kategori.id_kategori';

    //     return mysqli_query($this->koneksi, $sql);
    // }


// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Produk extends Model
// {
//     protected $table = 'produk';

//     protected $primaryKey = 'barcode';

//     public $timestamps = false;

//     public $incrementing = false;

//     protected $keyType = 'int';

//     protected $fillable = [
//         'barcode',
//         'id_produk',
//         'nama_produk',
//         'kategori',
//         'harga_beli',
//         'harga_jual',
//         'jumlah',
//     ];
