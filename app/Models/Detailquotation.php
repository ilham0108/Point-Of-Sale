<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailquotation extends Model
{
    use HasFactory;
    protected $table = "bz_dtailquotation";
    protected $fillable = [
        'kode_quotation',
        'id_produk', 
        'qty',
        'price',
        'diskon',
        'markup',
        'total',
        'status'
    ];

    function produk(){
        return $this->hasOne(Daftarproduk::class, 'cat_number', 'id_produk');
    }
}
