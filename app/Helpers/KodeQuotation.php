<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Quotation;
use Carbon\Carbon;

function KodeQuotation(){

    $now = Carbon::now();
    $userID = Auth::user()->id ;
    $thnbln = $now->year . $now->month;
    $cek = Quotation::count();
        if ($cek == 0) {
            $urut = 1001;
            $nomer = 'Q-' . $thnbln . $userID . $urut;
        } else {
            # code...
            $ambil = Quotation::all()->last();
            $urut  = (int)substr($ambil->kode_quotation, -4) + 1;
            $nomer = $nomer = 'Q-' . $thnbln . $userID . $urut;
        }
    return $nomer;
}
