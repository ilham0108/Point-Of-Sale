<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class Quotation extends Model
{
    use HasFactory;
    protected $table = "bz_quotation";
    protected $fillable = [
        'kode_quotation',
        'id_user',
        'name',
        'id_customer',
        'diskon2',
        'payment',
        'validity_qtt',
        'delivert_time',
        'created_at',
    ]; 

    function customer(){
        return $this->hasMany(Daftarcustomer::class, 'id', 'id_customer');
    }
}
