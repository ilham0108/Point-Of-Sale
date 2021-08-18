<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosupplierController extends Controller
{
    public function index()
    {
        $user = Auth::user()->name;
        return view('posupplier', compact('user'));
    }
}
