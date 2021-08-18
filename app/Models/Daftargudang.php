<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftargudang extends Model
{
    use HasFactory;
    protected $table = "bz_gudang";
    protected $guarded = array();

    protected $fillable = [
        'kode_gudang',
        'cat_number',
        'id_po',
        'date',
        'lot_number',
        'ED',
        'stock',
        'Note',
        'harga_beli'
    ]; 

}
