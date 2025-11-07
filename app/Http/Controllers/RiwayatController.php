<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function __construct() {}
    public function index()
    {
        $user = Auth::user();
        return view('riwayat', compact('user'));
    }
}
