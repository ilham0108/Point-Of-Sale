<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->name;

        $chart = Quotation::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

        $jumlahquotation = DB::table('bz_quotation')->count();
        $jumlahorder     = DB::table('bz_pocust')->count();
        $jumlahcustomer  = DB::table('bz_customer')->count();
        $jumlahproduk     = DB::table('bz_product')->count();
        
        return view('laporan', [
            'user'      => $user,
            'jumlahquotation'   => $jumlahquotation,
            'jumlahorder'       => $jumlahorder,
            'jumlahcustomer'    => $jumlahcustomer,
            'jumlahproduk'      => $jumlahproduk,
            'chart'             => $chart
        ]);
    }
}
