<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'parent_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_kategori', 'id_kategori');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_kategori', 'id_kategori');
    }
    public function transaksi()
    {
        return $this->hasMany(
            Transaksi::class,
            'id_kategori',
            'id_kategori'
        );
    }

}
