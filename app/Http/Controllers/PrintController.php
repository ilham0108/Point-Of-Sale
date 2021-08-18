<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Daftarproduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Daftarquotation;
use App\Models\Detailquotation;

class PrintController extends Controller
{
    public function index($kode_quotation){
        
        $user = Auth::user();
        $list_quotation = Daftarquotation::with('customer')
                        ->select('kode_quotation', 'name', 'id_customer', 'diskon2', 'payment', 'validity_qtt', 'delivert_time')
                        ->where('kode_quotation', $kode_quotation)
                        ->get();

        $detail_quotation = DB::table('bz_dtailquotation')
                            ->join('bz_product', 'bz_dtailquotation.id_produk', '=', 'bz_product.cat_number')
                            ->select('bz_dtailquotation.id_produk', 'bz_dtailquotation.diskon', 'bz_dtailquotation.price', 'bz_dtailquotation.markup', 'bz_product.cat_number', 'bz_product.nama_produk', 'bz_product.brand', 'bz_product.clone_type')
                            ->where('bz_dtailquotation.kode_quotation', $kode_quotation)
                            ->get();

        // return response()->json($list_quotation);

        // $daftar =  DB::table('bz_quotation')
        //     ->join('bz_dtailquotation', 'bz_quotation.kode_quotation', '=', 'bz_dtailquotation.kode_quotation')
        //     ->select('bz_quotation.*', 'bz_dtailquotation.*')
        //     ->get();

        // $daftar =  DB::table('bz_dtailquotation')
        //     ->select('bz_dtailquotation.*')
        //     ->where('kode_quotation', '')
        //     ->get();

        // $daftar = DB::table('bz_customer')
        //         ->select('bz_customer.*')
        //         ->where('kode_customer', '')
        //         ->get();
        // return response()->json($daftar);    
        
       //return response()->json($list_quotation);
        return view('print',[
            'data'      => $list_quotation,
            'produk'    => $detail_quotation,
            'user'      => $user
        ]);
    }
}
