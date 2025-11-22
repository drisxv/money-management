<?php

namespace App\Services;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

        // gunakan kolom 'jumlah' sesuai migrasi uang_masuks
        $totalMasuk = $uangMasukList->sum(fn($item) => (float) ($item->jumlah ?? 0));
        $totalKeluar = $uangKeluarList->sum(fn($item) => (float) ($item->jumlah ?? 0));
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

    public function storeUangMasuk(int $userId, array $data): UangMasuk
    {
        // mapping dari input ke kolom migrasi: sumber, jumlah, tanggal, catatan
        $sumber = isset($data['sumber']) ? trim((string)$data['sumber']) : (isset($data['source']) ? trim((string)$data['source']) : null);
        $jumlah = null;
        if (array_key_exists('jumlah', $data)) {
            $jumlah = (float) $data['jumlah'];
        } elseif (array_key_exists('amount', $data)) {
            $jumlah = (float) $data['amount'];
        }

        $tanggal = $data['tanggal'] ?? null;
        if ($tanggal !== null) {
            // normalisasi tanggal jika diberikan
            try {
                $tanggal = Carbon::parse($tanggal)->toDateString();
            } catch (\Throwable $e) {
                throw new \InvalidArgumentException('Format tanggal tidak valid.');
            }
        } else {
            $tanggal = Carbon::now()->toDateString();
        }

        $catatan = $data['catatan'] ?? ($data['note'] ?? null);

        if ($sumber === null || $sumber === '') {
            throw new \InvalidArgumentException('Field sumber harus diisi.');
        }

        if ($jumlah === null || $jumlah <= 0) {
            throw new \InvalidArgumentException('Jumlah harus lebih besar dari 0.');
        }

        $payload = [
            'user_id' => $userId,
            'sumber' => $sumber,
            'jumlah' => number_format($jumlah, 2, '.', ''), // pastikan format decimal sesuai
            'tanggal' => $tanggal,
            'catatan' => $catatan,
        ];

        return DB::transaction(function () use ($payload) {
            return UangMasuk::create($payload);
        });
    }
}
