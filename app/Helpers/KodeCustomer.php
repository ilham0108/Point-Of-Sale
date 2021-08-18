<?php

use App\Models\Daftarcustomer;

function KodeCustomer(){

        $nomor = rand(20);
        $kode = 'C-'. $nomor . 'B';
    return $kode;
}