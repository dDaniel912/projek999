<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    public $timestamps = false;

    protected $fillable = [
        'id_cabang',
        'id_user',
        'tanggal',
        'total',
        'pembayaran',
        'kembalian',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'total' => 'decimal:2',
        'pembayaran' => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];

    /**
     * Relasi ke cabang
     * Banyak transaksi terjadi pada satu cabang
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
     * Relasi ke user
     * Banyak transaksi dibuat oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    /**
     * Relasi ke detail transaksi
     * 1 transaksi memiliki banyak detail transaksi
     */
    public function detailTransaksi()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }
}
