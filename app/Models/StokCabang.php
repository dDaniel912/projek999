<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'branch_stok';

    protected $primaryKey = 'id_stok';

    public $timestamps = false;

    protected $fillable = [
        'branch_id',
        'id_produk',
        'barcode',
        'quantity',
        'reserved_quantity',
    ];

    /**
     * Relasi ke cabang
     * Banyak data stok berada dalam satu cabang
     */
    public function cabang()
    {
        return $this->belongsTo(
            Cabang::class,
            'id_cabang',
            'id_cabang'
        );
    }

    /**
     * Relasi ke produk
     * Banyak data stok dapat mengacu ke satu produk
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
    // protected $fillable = [
    //     'no_faktur', 'barcode', 'id_supplier', 'id_produk',
    //     'qty', 'lokasi', 'expired_date',
    // ];

    // protected $casts = ['expired_date' => 'date'];

    // public function produk()
    // {
    //     return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    // }

    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    // }