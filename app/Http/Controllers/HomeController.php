<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
use App\Services\UangService;

class HomeController extends Controller
{
    protected UangService $uangService;

    public function __construct(UangService $uangService)
    {
        $this->middleware('auth');
        $this->uangService = $uangService;
    }

    public function index()
    {
        $user = Auth::user();

        $cashFlow = $this->uangService->getCashFlow($user->id);

        return view('home', [
            'user' => $user,
            'uangMasuk' => $cashFlow['totalMasuk'],
            'uangKeluar' => $cashFlow['totalKeluar'],
            'totalCashFlow' => $cashFlow['totalCashFlow'],
            'persenMasuk' => $cashFlow['persenMasuk'],
            'persenKeluar' => $cashFlow['persenKeluar'],
            'uangMasukList' => $cashFlow['uangMasukList'],
            'uangKeluarList' => $cashFlow['uangKeluarList'],
        ]);
    }
}
