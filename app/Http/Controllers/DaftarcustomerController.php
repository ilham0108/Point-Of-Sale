<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Daftarcustomer;
use Illuminate\Support\Facades\Validator;
use DataTables;

class DaftarcustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $list_customer = Daftarcustomer::select('id', 'nama', 'institution', 'department', 'subdepartment', 'address', 'city', 'postcode', 'phone', 'fax', 'contactperson', 'title', 'email', 'note')
            ->where('id_user',  Auth::user()->id)
            ->get();
        if ($request->ajax()) {
            return datatables()->of($list_customer)
                ->addColumn('aksi', function ($list_customer) {
                    if (auth()->user()->jabatan == "Administrator" && "Staff IT") {
                        # code...
                        $button = '<center>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-link" onclick="edit(' . $list_customer->id . ')"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link" onclick="delete_data(' . $list_customer->id . ')"><i class="fas fa-trash"></i></button>
                </div></center>';
                        return $button;
                    } else {
                        # code...
                    }
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('daftarcustomer', [
            'user'          => $user,
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
            'nama'              => 'required',
            'institution'       => 'required',
            'department'        => 'required',
            'city'              => 'required',
            'contactperson'     => 'required',
            'email'             => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Daftarcustomer::updateOrCreate(
            ['id' => $request->id],
            [
                'id_user'           => $request->id_user,
                'nama'              => $request->nama,
                'institution'       => $request->institution,
                'department'        => $request->department,
                'subdepartment'     => $request->subdepartment,
                'address'           => $request->address,
                'city'              => $request->city,
                'postcode'          => $request->postcode,
                'phone'             => $request->phone,
                'fax'               => $request->fax,
                'contactperson'     => $request->contactperson,
                'title'             => $request->title,
                'email'             => $request->email,
                'note'              => $request->note,
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
        $data = Daftarcustomer::find($id);
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
        $data = Daftarcustomer::find($id)->delete();
    }
}
