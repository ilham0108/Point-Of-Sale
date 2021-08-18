<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarcustomer extends Model
{
    use HasFactory;
    protected $table = "bz_customer";

    protected $fillable = [
        'id_user',
        'nama',
        'institution',
        'department',
        'subdepartment',
        'address',
        'city',
        'postcode',
        'phone',
        'phone',
        'fax',
        'contactperson',
        'title',
        'email',
        'note',
    ]; 
}
