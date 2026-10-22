<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier'; 
    protected $primaryKey = 'id_supplier';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_supplier',
        'phone',
        'alamat',
    ];

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_supplier', 'id_supplier');
    }
    
    public $timestamps = false; 
}