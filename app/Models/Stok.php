<?php
// app/Models/Stok.php
namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table      = 'stok';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'no_faktur', 'barcode', 'id_supplier', 'id_produk',
        'qty', 'lokasi', 'expired_date',
    ];

    protected $casts = ['expired_date' => 'date'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
}
