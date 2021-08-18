<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Daftarproduk;
use Illuminate\Support\Facades\Validator;
use DataTables;

class DataprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user()->name;
        $list_produk = Daftarproduk::select('id', 'cat_number', 'brand', 'nama_produk', 'host', 'reactivity', 'clone_type', 'application', 'pack_size', 'type_product', 'pack_category', 'price', 'disc')
                        ->where('clone_type', $request->get('filter1'))
                        ->where('type_product', $request->get('filter2'))
                        ->where('pack_category', $request->get('filter3'))    
                        ->get();
            
        if ($request->ajax()) {
            return datatables()->of($list_produk)
                ->addColumn('aksi', function ($list_produk) {
                    $button = '<center>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-link" onclick="edit(' . $list_produk->id . ')"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link" onclick="delete_data(' . $list_produk->id . ')"><i class="fas fa-trash"></i></button>
                </div></center>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('daftarproduk', [
                        'user'      => $user,
                        'produk'    => $list_produk
        ]);
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
            'cat_number'     => 'required',
            'brand'          => 'required',
            'nama_produk'    => 'required',
            'host'           => 'required',
            'reactivity'     => 'required',
            'clone_type'     => 'required',
            'application'    => 'required',
            'pack_size'      => 'required',
            'type_product'   => 'required',
            'price'          => 'required',
            'disc'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Daftarproduk::updateOrCreate(
            ['id' => $request->id],
            [
                'cat_number'     => $request->cat_number,
                'brand'          => $request->brand,
                'nama_produk'    => $request->nama_produk,
                'host'           => $request->host,
                'reactivity'     => $request->reactivity,
                'clone_type'     => $request->clone_type,
                'application'    => $request->application,
                'pack_size'      => $request->pack_size,
                'type_product'   => $request->type_product,
                'price'          => $request->price,
                'disc'           => $request->disc,
            ]
        );

        return response()->json(['status' => true]);
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
        $data = Daftarproduk::find($id);
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
        $data = Daftarproduk::find($id)->delete();
    }
}
