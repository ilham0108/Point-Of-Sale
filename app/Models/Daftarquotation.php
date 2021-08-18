<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarquotation extends Model
{
    use HasFactory;
    protected $table = "bz_quotation";
    protected $fillable = [
        'kode_quotation',
        'nama_sales',
        'id_customer',
        'validity_qtt',
        'delivert_time',

    ];

    

    function Detailquotation(){
        return $this->hasMany(Detailquotation::class, 'kode_quotation', 'nama');
    }

    function customer(){
        return $this->hasMany(Daftarcustomer::class, 'id', 'id_customer');
    }

}
