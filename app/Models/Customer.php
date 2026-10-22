<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; 
    protected $primaryKey = 'id_customer';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_customer',
        'phone',
        'alamat',
    ];
    public $timestamps = false; 
}
