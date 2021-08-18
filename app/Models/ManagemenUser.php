<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagemenUser extends Model
{
    use HasFactory;
    protected $table = "bz_user";
    protected $fillable = [
        'name',
        'email',
        'jabatan',
        'password',
    ];
    
}
