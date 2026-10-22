<?php
// app/Models/Mutasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table      = 'mutasi';      // ganti jika nama tabel Anda berbeda
    protected $primaryKey = 'id_mutasi';

    protected $fillable = [
        'nomor_mutasi', 'asal_cabang', 'tujuan_cabang', 'barcode',
        'transfer_date', 'jumlah', 'status', 'requested_by', 'approved_by',
        'shipped_at', 'received_at', 'notes',
    ];

    protected $casts = [
        'transfer_date' => 'datetime',
        'shipped_at'    => 'datetime',
        'received_at'   => 'datetime',
    ];

    // asal_cabang -> cabang.id_cabang
    public function asal()
    {
        return $this->belongsTo(Cabang::class, 'asal_cabang', 'id_cabang');
    }

    // tujuan_cabang -> cabang.id_cabang
    public function tujuan()
    {
        return $this->belongsTo(Cabang::class, 'tujuan_cabang', 'id_cabang');
    }
    public function pemohon()
    {
        return $this->belongsTo(\App\Models\User::class, 'requested_by');
    }
 
    // approved_by -> users.id
    public function penyetuju()
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }
}
