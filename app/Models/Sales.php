<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = "bz_sales";
    protected $fillable = [
        'kode_sales',
        'nama_sales', 
        'telp',
        'email'
    ];
}
