<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'branches';

    protected $primaryKey = 'id_cabang';

    public $timestamps = false;

    protected $fillable = [
        'nama_cabang',
        'alamat',
        'phone',
        'email',
        'kode_cabang',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_cabang', 'id_cabang');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_cabang', 'id_cabang');
    }
    public function transaksi()
    {
        return $this->hasMany(
            Transaksi::class,
            'id_cabang',
            'id_cabang'
        );
    }

}
