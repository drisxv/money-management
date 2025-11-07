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

        $totalMasuk = $uangMasukList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);
        $totalKeluar = $uangKeluarList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);

        $totalCashFlow = $totalMasuk - $totalKeluar;

        // Jika kedua total nol, kedua persentase nol — cegah pembagian nol
        if ($totalMasuk == 0 && $totalKeluar == 0) {
            $persenMasuk = 0;
            $persenKeluar = 0;
        } elseif ($totalMasuk == $totalKeluar) {
            // Sama dan pasti > 0 karena kasus nol ditangani
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
