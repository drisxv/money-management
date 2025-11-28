<?php

namespace App\Services;

use App\Models\DataUang;
use App\Models\UangMasuk;
use App\Models\UangKeluar;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UangService
{
    public function getTotalExpenseByType(int $userId, string $bulan): array
    {
        $year  = substr($bulan, 0, 4);
        $month = substr($bulan, 5, 2);

        $pengeluaran = UangKeluar::with('subKategori.kategori')
            ->where('user_id', $userId)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get();

        $result = [];

        foreach ($pengeluaran as $item) {
            $id = $item->subKategori->kategori->id;

            if (!isset($result[$id])) {
                $result[$id] = 0;
            }

            $result[$id] += (float) $item->jumlah;
        }

        return $result;
    }

    public function getAlokasiByKategori(int $userId, string $bulan): array
    {
        return DataUang::where('user_id', $userId)
            ->where('bulan', $bulan)
            ->get()
            ->groupBy('kategori_id')
            ->map(fn($items) => (float) $items->sum('jumlah'))
            ->toArray();
    }

    public function getRangkumanBudget(int $userId, string $bulan): array
    {
        $year  = substr($bulan, 0, 4);
        $month = substr($bulan, 5, 2);

        $totalMasuk = UangMasuk::where('user_id', $userId)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->sum('jumlah');

        $kategoris = Kategori::all();

        $pengeluaran = $this->getTotalExpenseByType($userId, $bulan);

        $alokasi = $this->getAlokasiByKategori($userId, $bulan);

        $budget = [];
        $sisa   = [];

        foreach ($kategoris as $kategori) {
            $id = $kategori->id;

            $budget[$id] = $alokasi[$id] ?? 0;
            $keluar      = $pengeluaran[$id] ?? 0;

            $sisa[$id] = $budget[$id] - $keluar;
        }

        return [
            'totalMasuk'  => (float) $totalMasuk,
            'pengeluaran' => $pengeluaran, 
            'budget'      => $budget,      
            'sisa'        => $sisa,        
            'kategoris'   => $kategoris,  
        ];
    }

    public function prosesPemasukanDenganBagi(array $data)
    {
        $userId = Auth::id();

        $uangMasuk = UangMasuk::create([
            'user_id' => $userId,
            'sumber'  => $data['sumber'],
            'jumlah'  => $data['jumlah'],
            'tanggal' => now(),
            'catatan' => $data['catatan'] ?? null,
        ]);

        $bulan  = Carbon::parse($uangMasuk->tanggal)->format('Y-m');
        $jumlah = $uangMasuk->jumlah;

        $kategoris = Kategori::all();

        foreach ($kategoris as $kategori) {

            $jumlahDibagi = ($jumlah * $kategori->persentase) / 100;

            $existing = DataUang::where('user_id', $userId)
                ->where('kategori_id', $kategori->id)
                ->where('bulan', $bulan)
                ->first();

            if ($existing) {
                $existing->update([
                    'jumlah' => $existing->jumlah + $jumlahDibagi
                ]);
            } else {
                DataUang::create([
                    'user_id'     => $userId,
                    'kategori_id' => $kategori->id,
                    'jumlah'      => $jumlahDibagi,
                    'bulan'       => $bulan,
                ]);
            }
        }

        return $uangMasuk;
    }

    public function prosesPengeluaran(array $data)
    {
        $userId = Auth::id();

        if (empty($data['sub_kategori_id']) || empty($data['deskripsi']) || empty($data['jumlah'])) {
            throw new \Exception('Data pengeluaran tidak lengkap');
        }

        $subKategori = SubKategori::with('kategori')->find($data['sub_kategori_id']);
        if (!$subKategori || !$subKategori->kategori) {
            throw new \Exception('Sub kategori tidak ditemukan');
        }

        $rawJumlah = (string) $data['jumlah'];
        $normalized = str_replace('.', '', $rawJumlah);
        $normalized = str_replace(',', '.', $normalized);
        $amount = (float) $normalized;

        if ($amount <= 0) {
            throw new \Exception('Jumlah tidak valid');
        }

        $kategoriId = $subKategori->kategori->id;

        $bulan = isset($data['tanggal']) ? Carbon::parse($data['tanggal'])->format('Y-m') : Carbon::now()->format('Y-m');

        $dataUang = DataUang::where('user_id', $userId)
            ->where('kategori_id', $kategoriId)
            ->where('bulan', $bulan)
            ->first();

        if (!$dataUang) {
            throw new \Exception('Alokasi untuk kategori ini belum tersedia pada bulan dipilih');
        }

        if ((float) $dataUang->jumlah < $amount) {
            throw new \Exception('Saldo alokasi kategori tidak mencukupi');
        }

        $uangKeluar = null;

        DB::transaction(function () use ($userId, $subKategori, $amount, $data, &$uangKeluar, $dataUang) {
            $uangKeluar = UangKeluar::create([
                'user_id' => $userId,
                'sub_kategori_id' => $subKategori->id,
                'deskripsi' => $data['deskripsi'],
                'jumlah' => $amount,
                'tanggal' => $data['tanggal'] ?? now(),
                'catatan' => $data['catatan'] ?? null,
            ]);

            $dataUang->jumlah = (float) $dataUang->jumlah - $amount;
            $dataUang->save();
        });

        return $uangKeluar;
    }
    
    public function previewPengeluaran(array $data): array
    {
        $userId = Auth::id();

        if (empty($data['sub_kategori_id']) || !isset($data['jumlah'])) {
            throw new \Exception('sub_kategori_id dan jumlah diperlukan untuk preview');
        }

        $subKategori = SubKategori::with('kategori')->find($data['sub_kategori_id']);
        if (!$subKategori || !$subKategori->kategori) {
            throw new \Exception('Sub kategori tidak ditemukan');
        }

        $rawJumlah = (string) $data['jumlah'];
        $normalized = str_replace('.', '', $rawJumlah);
        $normalized = str_replace(',', '.', $normalized);
        $amount = (float) $normalized;

        $kategoriId = $subKategori->kategori->id;
        $bulan = isset($data['tanggal']) ? Carbon::parse($data['tanggal'])->format('Y-m') : Carbon::now()->format('Y-m');

        $dataUang = DataUang::where('user_id', $userId)
            ->where('kategori_id', $kategoriId)
            ->where('bulan', $bulan)
            ->first();

        $allocation = $dataUang ? (float) $dataUang->jumlah : 0.0;
        $remaining = $allocation - $amount;

        return [
            'allocation' => $allocation,
            'remaining' => $remaining,
            'ok' => $allocation >= $amount,
            'kategori_id' => $kategoriId,
        ];
    }
}
