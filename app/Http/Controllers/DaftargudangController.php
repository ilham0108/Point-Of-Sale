<?php

namespace App\Http\Controllers;

use App\Models\Daftargudang;
use App\Providers\daftargudang as ProvidersDaftargudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;

class DaftargudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        {
            $user = Auth::user()->name;
            $list_gudang = Daftargudang::get();
            if($request->ajax()){
                return datatables()->of($list_gudang)
                ->addColumn('aksi', function($list_gudang){
                    $button = '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $list_gudang->id . ')"><i class="fas fa-edit"></i></a>';
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete" onclick="delete_data(' . $list_gudang->id . ')"><i class="fas fa-trash"></i></a>';
                    
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    
            }        
            return view('daftargudang', compact('user'));
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_gudang'     => 'required',
            'cat_number'      => 'required',
            'id_po'           => 'required',
            'date'            => 'required',
            'lot_number'      => 'required',
            'ED'              => 'required',
            'stock'           => 'required',
            'harga_beli'      => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        Daftargudang::create([
            'kode_gudang'     => $request->kode_gudang,
            'cat_number'      => $request->cat_number,
            'id_po'           => $request->id_po,
            'date'            => $request->date,
            'lot_number'      => $request->lot_number,
            'ED'              => $request->ED,
            'stock'           => $request->stock,
            'Note'            => $request->Note,
            'harga_beli'      => $request->harga_beli,
        ]);   

        return response()->json(['status'=> true]);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftargudang  $daftargudang
     * @return \Illuminate\Http\Response
     */
    public function show(Daftargudang $daftargudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daftargudang  $daftargudang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daftargudang = Daftargudang::where('id', $id)->first();
        return response()->json($daftargudang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daftargudang  $daftargudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    public function update_data(Request $request){

        $data = Daftargudang::where('id',  $request->id)
            ->update([
                'kode_gudang'     => $request->kode_gudang,
                'cat_number'      => $request->cat_number,
                'id_po'           => $request->id_po,
                'date'            => $request->date,
                'lot_number'      => $request->lot_number,
                'ED'              => $request->ED,
                'stock'           => $request->stock,
                'Note'            => $request->Note,
                'harga_beli'      => $request->harga_beli,
            ]); 

        return response()->json(['status'=> $data]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftargudang  $daftargudang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Daftargudang::where('id', $id)->delete();
    }
}
