<?php

namespace App\Http\Controllers;

use App\Models\Daftarcustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Daftarproduk;
use App\Models\Daftarquotation;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\DB;

class DaftarquotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->name;


        $list_quotation = Daftarquotation::with('customer')->select('id', 'kode_quotation', 'name', 'id_customer', 'payment', 'validity_qtt', 'delivert_time')
            ->where('id_user', Auth::user()->id)
            ->get();




        //return response()->json($list_quotation);

        // $list_quotation =  DB::table('bz_quotation')
        //     ->join('bz_customer', 'bz_quotation.nama', '=', 'bz_customer.id')
        //     ->select('bz_quotation.*', 'bz_customer.id as hello')
        //     ->get();

        if ($request->ajax()) {
            return datatables()->of($list_quotation)
                ->addColumn('redirect', function ($list_quotation) {
                    if (auth()->user()->jabatan == "Administrator" && "Staff IT") {
                        $button = '<center>
                        <a href="/print/' . $list_quotation->kode_quotation . '" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="top" title="print"><i class="fas fa-print"></i></a>
                        <button type="button" class="btn btn-link" title="delete" onclick="delete_data(' . $list_quotation->id . ')"><i class="fas fa-trash"></i></button>
                        </center>';
                        return $button;
                    } else {
                        # code...
                    }
                })
                ->rawColumns(['redirect'])
                ->make(true);
        }

        return view('daftarquotation', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Daftarcustomer::find($id);
        return response()->json($data);
    }

    public function print($id)
    {
        $data = Daftarquotation::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Daftarquotation::find($id)->delete();
    }
}
