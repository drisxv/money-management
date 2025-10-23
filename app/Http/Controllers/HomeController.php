<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UangMasuk;
use App\Models\UangKeluar;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $uangMasukList = UangMasuk::where('user_id', $user->id)->latest()->get();
        $uangKeluarList = UangKeluar::where('user_id', $user->id)->latest()->get();

        // $totalMasuk = $uangMasukList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);
        // $totalKeluar = $uangKeluarList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);
        $totalMasuk = 500000;
        $totalKeluar = 300000;

        $totalCashFlow = $totalMasuk - $totalKeluar;

        // Cegah pembagian nol
        $maxValue = max($totalMasuk, $totalKeluar, 1);

        // Hitung proporsi
        if ($totalMasuk == $totalKeluar && $totalMasuk > 0) {
            // Kalau sama, dua-duanya full
            $persenMasuk = 100;
            $persenKeluar = 100;
        } elseif ($totalMasuk > $totalKeluar) {
            // Kalau pemasukan lebih besar → hijau full, merah proporsional
            $persenMasuk = 100;
            $persenKeluar = ($totalKeluar / $totalMasuk) * 100;
        } else {
            // Kalau pengeluaran lebih besar → merah full, hijau proporsional
            $persenKeluar = 100;
            $persenMasuk = ($totalMasuk / $totalKeluar) * 100;
        }

        return view('home', [
            'user' => $user,
            'uangMasuk' => $totalMasuk,
            'uangKeluar' => $totalKeluar,
            'totalCashFlow' => $totalCashFlow,
            'persenMasuk' => $persenMasuk,
            'persenKeluar' => $persenKeluar,
            'uangMasukList' => $uangMasukList,
            'uangKeluarList' => $uangKeluarList,
        ]);
    }
}
