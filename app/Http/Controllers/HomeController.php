<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UangService;
use App\Services\RiwayatService;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct(protected UangService $uangService, protected RiwayatService $riwayatService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user  = Auth::user();
        $bulan = Carbon::now()->format('Y-m');

        $summary = $this->uangService->getRangkumanBudget($user->id, $bulan);

        $uangMasuk     = $summary['totalMasuk'];
        $pengeluaran   = array_sum($summary['pengeluaran']); // total semua pengeluaran
        $totalCashFlow = $uangMasuk - $pengeluaran;

        $persenMasuk  = $uangMasuk > 0 ? 100 : 0;
        $persenKeluar = $uangMasuk > 0 ? min(100, ($pengeluaran / $uangMasuk) * 100) : 0;

        return view('home', [
            'user' => $user,
            'totalCashFlow' => $totalCashFlow,
            'uangMasuk'     => $uangMasuk,
            'uangKeluar'    => $pengeluaran,
            'persenMasuk'   => $persenMasuk,
            'persenKeluar'  => $persenKeluar,
            'pengeluaranById' => $summary['pengeluaran'],
            'budget'          => $summary['budget'],
            'sisa'            => $summary['sisa'],
            'kategoris'       => $summary['kategoris'],
            'latestPengeluaran' => $this->riwayatService->getUangKeluarHome($user->id, 6),
        ]);
    }
}
