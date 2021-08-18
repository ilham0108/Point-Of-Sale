<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->name;
        $list_user = User::select('id','name', 'jabatan', 'phone', 'email', 'password')->get();

        //return response()->json($list_user);
            
        if ($request->ajax()) {
            return datatables()->of($list_user)
                ->addColumn('aksi', function ($list_user) {
                    $button = '<center>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-link" onclick="edit(' . $list_user->id . ')"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link" onclick="delete_data(' . $list_user->id . ')"><i class="fas fa-trash"></i></button>
                </div></center>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('managemenuser', [
                    'user'          => $user,
                    'daftaruser'    => $list_user
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
            'name'           => 'required',
            'jabatan'        => 'required',
            'email'          => 'required',
            'password'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        User::updateOrCreate(
            ['id' => $request->id],
            [
                'name'           => $request->name,
                'jabatan'        => $request->jabatan,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
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
        $data = User::find($id);
                
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
        $data = User::find($id)->delete();
    }
}
