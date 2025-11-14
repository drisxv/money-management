<?php

namespace App\Services;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Database\Eloquent\Collection;

class UangService
{
    public function getUangMasukByUserId(int $userId): Collection
    {
        return UangMasuk::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function getUangKeluarByUserId(int $userId): Collection
    {
        return UangKeluar::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function getCashFlow(int $userId): array
    {
        $uangMasukList = $this->getUangMasukByUserId($userId);
        $uangKeluarList = $this->getUangKeluarByUserId($userId);

        $totalMasuk = $uangMasukList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);
        $totalKeluar = $uangKeluarList->sum(fn($item) => $item->nominal ?? $item->amount ?? 0);
        $totalCashFlow = $totalMasuk - $totalKeluar;

        // Hindari pembagian dengan nol
        if ($totalMasuk == 0 && $totalKeluar == 0) {
            $persenMasuk = 0;
            $persenKeluar = 0;
        } elseif ($totalMasuk == $totalKeluar) {
            $persenMasuk = 100;
            $persenKeluar = 100;
        } elseif ($totalMasuk > $totalKeluar) {
            $persenMasuk = 100;
            $persenKeluar = ($totalKeluar / $totalMasuk) * 100;
        } else {
            $persenKeluar = 100;
            $persenMasuk = ($totalMasuk / $totalKeluar) * 100;
        }

        return [
            'uangMasukList' => $uangMasukList,
            'uangKeluarList' => $uangKeluarList,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalCashFlow' => $totalCashFlow,
            'persenMasuk' => $persenMasuk,
            'persenKeluar' => $persenKeluar,
        ];
    }
}
