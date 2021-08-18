<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Daftarproduk;
use App\Models\Daftarcustomer;
use App\Models\Quotation;
use App\Models\Detailquotation;
use Illuminate\Support\Facades\Validator;
use DataTables;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->name;
        $user_Id = Auth::user()->id ;

        $daftarcustomer = Daftarcustomer::select('id', 'nama')
            ->where('id_user', Auth::user()->id)
            ->get();

            
            $list_produk = Daftarproduk::select('id', 'cat_number', 'brand', 'nama_produk', 'host', 'reactivity', 'clone_type', 'application', 'pack_size', 'type_product', 'price', 'disc', 'pack_category')
                            ->where('clone_type', $request->get('filter1'))
                            ->where('type_product', $request->get('filter2'))
                            ->where('pack_category', $request->get('filter3'))
                            ->get();
                // return response()->json($list_produk);

                
        if ($request->ajax()) {
            return datatables()->of($list_produk)
                ->addColumn('aksi', function ($list_produk) {
                    $button = '<a href="javascript:void(0)" class="btn btntambah btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="tambah_barang" onclick="tambah_barang(' . $list_produk->id . ')"><i class="fas fa-plus-square"></i></a>';
                    return $button;
                })
                ->addColumn('disc', function($list_produk){
                    $disc = $list_produk->disc * 100 . '%';
                    return $disc;

                })
                
                ->rawColumns(['aksi', 'disc'])
                ->make(true);
        }
    

        return view('quotation', [
            'daftarcustomer'    => $daftarcustomer,
            'kode'              => KodeQuotation(),
            'user'              => $user,
            'user_id'           => $user_Id,
        ]);
    }

    function detail_quotation()
    {
        $data = Detailquotation::with(['produk'])->where('status', 'F')->get();
        return datatables()->of($data)
        ->addColumn('markup', function ($data) {
            if ($data->markup == "0.95") {
                
                $markup = '<form id="formmarkup' . $data->id . '">
                <input type="hidden" name="id" value="' . $data->id . '">
                <select id="markup" name="markup" class="form-control" title="diskon" onchange="post_markup(' . $data->id . ')">
                <option value=""> - Pilih - </option>
                <option value="0.95" selected>  5% </option>
                <option value="0.9" > 10% </option>
                <option value="0.85"> 15% </option>
                <option value="0.8" > 20% </option>
                </select>
                </form>';
            } elseif ($data->markup == "0.9") {
                
                $markup = '<form id="formmarkup' . $data->id . '">
                <input type="hidden" name="id" value="' . $data->id . '">
                <select id="markup" name="markup" class="form-control" title="diskon" onchange="post_markup(' . $data->id . ')">
                <option value=""> - Pilih - </option>
                <option value="0.95">  5% </option>
                <option value="0.9" selected> 10% </option>
                <option value="0.85"> 15% </option>
                <option value="0.8" > 20% </option>
                </select>
                </form>';
            } elseif ($data->markup == "0.85") {
                
                    $markup = '<form id="formmarkup' . $data->id . '">
                    <input type="hidden" name="id" value="' . $data->id . '">
                    <select id="markup" name="markup" class="form-control" title="diskon" onchange="post_markup(' . $data->id . ')">
                        <option value=""> - Pilih - </option>
                        <option value="0.95">  5% </option>
                        <option value="0.9" > 10% </option>
                        <option value="0.85" selected> 15% </option>
                        <option value="0.8" > 20% </option>
                        </select>
                        </form>';
                    } elseif ($data->markup == "0.8") {
                        
                        $markup = '<form id="formmarkup' . $data->id . '">
                        <input type="hidden" name="id" value="' . $data->id . '">
                        <select id="markup" name="markup" class="form-control" title="diskon" onchange="post_markup(' . $data->id . ')">
                        <option value=""> - Pilih - </option>
                        <option value="0.95"         >  5% </option>
                        <option value="0.9"          > 10% </option>
                        <option value="0.85"         > 15% </option>
                        <option value="0.8" selected > 20% </option>
                        </select>
                        </form>';
                    } else {
                        $markup = '<form id="formmarkup' . $data->id . '">
                        <input type="hidden" name="id" value="' . $data->id . '">
                        <select id="markup" name="markup" class="form-control" title="diskon" onchange="post_markup(' . $data->id . ')">
                        <option value=""> - Pilih - </option>
                        <option value="0.95">  5% </option>
                        <option value="0.9" > 10% </option>
                        <option value="0.85"> 15% </option>
                        <option value="0.8" > 20% </option>
                        </select>
                        </form>';
                    }
                    
                    
                    
                    return $markup;
                })
                ->addColumn('total', function ($data) {
                    if ($data->markup != null) {
                        $total = '<div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="total" name="total" value="' . number_format($data->price / $data->markup) . '" readonly>
                        </div>
                        </div>';
                    } else {
                        $total = '<div class="form-group">
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="total" name="total" value="" readonly>
                        </div>
                        </div>';
                    }
                    
                    return $total;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<center>
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-link" onclick="delete_data(' . $data->id . ')"><i class="fas fa-trash"></i></button>
                    </div></center>';
                    return $button;
                })
                
                
                ->rawColumns([ 'markup', 'total', 'aksi'])
                ->make(true);
            }
            // ->addColumn('diskon', function ($data) {

            //     if ($data->diskon != null) {

            //         $dropdown = '<form id="formdiskon' . $data->id . '">
            //                     <input type="hidden" name="id_diskon" value="' . $data->id . '">
            //                         <select id="disc" name="disc" class="form-control" onchange="post_diskon(' . $data->id . ')">
            //                             <option value=""> - Pilih - </option>
            //                             <option value="0.05">  5% </option>
            //                             <option value="0.1" > 10% </option>
            //                             <option value="0.15"> 15% </option>
            //                             <option value="0.2" > 20% </option>
            //                             <option value="0.25"> 25% </option>
            //                         </select>
            //                         </form>';
            //     } elseif ($data->diskon == "0.05") {

            //         $dropdown = '<form id="formdiskon' . $data->id . '">
            //                     <input type="hidden" name="id_diskon" value="' . $data->id . '">
            //                         <select id="disc" name="disc" class="form-control" onchange="post_diskon(' . $data->id . ')">
            //                             <option value=""> - Pilih - </option>
            //                             <option value="0.05" selected>  5% </option>
            //                             <option value="0.1" > 10% </option>
            //                             <option value="0.15"> 15% </option>
            //                             <option value="0.2" > 20% </option>
            //                             <option value="0.25"> 25% </option>
            //                         </select>
            //                         </form>';
            //     } elseif ($data->diskon == "0.1") {

            //         $dropdown = '<form id="formdiskon' . $data->id . '">
            //                     <input type="hidden" name="id_diskon" value="' . $data->id . '">
            //                         <select id="disc" name="disc" class="form-control" onchange="post_diskon(' . $data->id . ')">
            //                             <option value=""> - Pilih - </option>
            //                             <option value="0.05">  5% </option>
            //                             <option value="0.1" selected> 10% </option>
            //                             <option value="0.15"> 15% </option>
            //                             <option value="0.2" > 20% </option>
            //                             <option value="0.25"> 25% </option>
            //                         </select>
            //                         </form>';
            //     }elseif($data->diskon == "0.15"){

            //         $dropdown = '<form id="formdiskon' . $data->id . '">
            //                     <input type="hidden" name="id_diskon" value="' . $data->id . '">
            //                         <select id="disc" name="disc" class="form-control" onchange="post_diskon(' . $data->id . ')">
            //                             <option value=""> - Pilih - </option>
            //                             <option value="0.05">  5% </option>
            //                             <option value="0.1" > 10% </option>
            //                             <option value="0.15" selected> 15% </option>
            //                             <option value="0.2" > 20% </option>
            //                             <option value="0.25"> 25% </option>
            //                         </select>
            //                         </form>';

            //     }else {
            //         $dropdown = '<select id="disc" name="disc" class="form-control" disabled>
            //         <option value=""> - Pilih - </option>
            //         </select>';
            //     }

            //     return $dropdown;
            // })
            
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validator = Validator::make($request->all(), [

            'kode_quotation'      => 'required',
            'name'                => 'required',
            'payment'             => 'required',
            'validity_qtt'        => 'required',
            'delivert_time'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Quotation::updateOrCreate(
            ['id' => $request->id],
            [
                'kode_quotation'      => $request->kode_quotation,
                'id_user'             => $request->id_user,
                'name'                => $request->name,
                'id_customer'         => $request->customer,
                'diskon2'             => $request->diskon2,
                'payment'             => $request->payment,
                'validity_qtt'        => $request->validity_qtt,
                'delivert_time'       => $request->delivert_time,
            ]
        );

        Detailquotation::where('kode_quotation', $request->kode_quotation)
            ->update(['status' => 'T']);

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_daftarproduk($id)
    {
        $data = Daftarproduk::find($id);

        $cek = Detailquotation::where('id_produk', $data->cat_number)
            ->where('kode_quotation', KodeQuotation())
            ->get();

        if (count($cek) > 0) {

            Detailquotation::where('id_produk', $data->cat_number)
                ->where('kode_quotation', KodeQuotation())
                ->update([
                    'qty'               => $cek[0]->qty + 1,
                ]);
        } else {
            if ($data->disc <= 0) {
                Detailquotation::Create([
                    'kode_quotation'    => KodeQuotation(),
                    'id_produk'         => $data->cat_number,
                    'qty'               => 1,
                    'price'             => $data->price,
                    'diskon'            => null,
                    'markup'            => 0,
                ]);
            } else {
                Detailquotation::Create([
                    'kode_quotation'    => KodeQuotation(),
                    'id_produk'         => $data->cat_number,
                    'qty'               => 1,
                    'price'             => $data->price,
                    'diskon'            => $data->disc,
                    'markup'            => 0,
                ]);
            }
        }

        return response()->json(true);
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

    function add_markup(Request $request)
    {

        Detailquotation::where('id', $request->id)
            ->update([
                'markup'                => $request->markup,
            ]);

        return response()->json(true);
    }

    function add_diskon(Request $request)
    {

        Detailquotation::where('id', $request->id_diskon)
            ->update([
                'diskon'   => $request->disc,
            ]);

        return response()->json(true);
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
        $data = Detailquotation::find($id)->delete();
    }
}
