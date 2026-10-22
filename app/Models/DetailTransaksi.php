<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $primaryKey = 'id_detail';

    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'barcode',
        'jumlah',
        'harga',
        'subtotal',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relasi ke transaksi
     * Banyak detail transaksi berada dalam satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    /**
     * Relasi ke produk
     * Banyak detail dapat mengacu ke satu produk
     */
    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'barcode',
            'barcode'
        );
    }
}
