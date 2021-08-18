<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarproduk extends Model
{
    use HasFactory;
    protected $table = "bz_product";

    protected $fillable = [
        'cat_number',
        'brand',
        'nama_produk',
        'host',
        'reactivity',
        'clone_type',
        'application',
        'pack_size',
        'type_product',
        'price',
        'disc',
    ]; 
}
