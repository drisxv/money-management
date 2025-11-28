<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\UangKeluar;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class RiwayatService
{
    public function fetchRiwayat(int $userId, array $filters = [], int $perPage = 15)
    {
        $masukQ = DB::table('uang_masuks')
            ->where('user_id', $userId)
            ->select([
                'uang_masuks.id as entry_id',
                DB::raw("'masuk' as type"),
                'sumber as description',
                'jumlah as amount',
                'tanggal',
                'uang_masuks.created_at as created_at',
                DB::raw('NULL as kategori_id'),
                DB::raw('NULL as kategori_nama'),
                DB::raw('NULL as sub_kategori_id'),
                DB::raw('NULL as sub_kategori_nama'),
                'catatan'
            ]);

        $keluarQ = DB::table('uang_keluars')
            ->join('sub_kategoris', 'sub_kategoris.id', '=', 'uang_keluars.sub_kategori_id')
            ->join('kategoris', 'kategoris.id', '=', 'sub_kategoris.kategori_id')
            ->where('uang_keluars.user_id', $userId)
            ->select([
                'uang_keluars.id as entry_id',
                DB::raw("'keluar' as type"),
                'deskripsi as description',
                'jumlah as amount',
                'tanggal',
                'uang_keluars.created_at as created_at',
                'kategoris.id as kategori_id',
                'kategoris.nama as kategori_nama',
                'sub_kategoris.id as sub_kategori_id',
                'sub_kategoris.nama as sub_kategori_nama',
                'uang_keluars.catatan'
            ]);

        $union = $masukQ->unionAll($keluarQ);

        $query = DB::query()->fromSub($union, 't')->select('*')->orderBy('created_at', 'desc');

        if (!empty($filters['start_date'])) {
            $query->where('tanggal', '>=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $query->where('tanggal', '<=', $filters['end_date']);
        }
        if (!empty($filters['tipe'])) {
            $query->where('type', $filters['tipe']);
        }
        if (!empty($filters['kategori_id'])) {
            $query->where('kategori_id', (int) $filters['kategori_id']);
        }

        $paginator = $query->paginate($perPage);

        return $paginator;
    }

    public function fetchDailySummary(int $userId, array $filters = [], int $days = 7)
    {
        $startDate = $filters['start_date'] ?? null;
        $endDate = $filters['end_date'] ?? null;
        $kategoriId = $filters['kategori_id'] ?? null;

        $masukQ = DB::table('uang_masuks')
            ->where('user_id', $userId)
            ->when($startDate, function ($q) use ($startDate) {
                $q->where('tanggal', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
                $q->where('tanggal', '<=', $endDate);
            })
            ->select(DB::raw("DATE(tanggal) as day"), DB::raw("'masuk' as type"), DB::raw('jumlah as amount'));

        $keluarQ = DB::table('uang_keluars')
            ->join('sub_kategoris', 'sub_kategoris.id', '=', 'uang_keluars.sub_kategori_id')
            ->join('kategoris', 'kategoris.id', '=', 'sub_kategoris.kategori_id')
            ->where('uang_keluars.user_id', $userId)
            ->when($startDate, function ($q) use ($startDate) {
                $q->where('uang_keluars.tanggal', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
                $q->where('uang_keluars.tanggal', '<=', $endDate);
            })
            ->when($kategoriId, function ($q) use ($kategoriId) {
                $q->where('kategoris.id', (int) $kategoriId);
            })
            ->select(DB::raw("DATE(uang_keluars.tanggal) as day"), DB::raw("'keluar' as type"), DB::raw('jumlah as amount'));

        $union = $masukQ->unionAll($keluarQ);

        $daysList = DB::query()
            ->fromSub($union, 't')
            ->select('day')
            ->distinct()
            ->orderBy('day', 'desc')
            ->limit($days)
            ->pluck('day')
            ->toArray();

        if (empty($daysList)) {
            return collect();
        }

        $rows = DB::query()
            ->fromSub($union, 't')
            ->select('day', 'type', DB::raw('count(*) as count'), DB::raw('sum(amount) as total'))
            ->whereIn('day', $daysList)
            ->groupBy('day', 'type')
            ->orderBy('day', 'desc')
            ->get();

        $result = collect($daysList)->map(function ($day) use ($rows) {
            $masuk = $rows->first(function ($r) use ($day) {
                return $r->day == $day && $r->type == 'masuk';
            });
            $keluar = $rows->first(function ($r) use ($day) {
                return $r->day == $day && $r->type == 'keluar';
            });

            return (object) [
                'day' => $day,
                'masuk_count' => $masuk->count ?? 0,
                'masuk_total' => $masuk->total ?? 0,
                'keluar_count' => $keluar->count ?? 0,
                'keluar_total' => $keluar->total ?? 0,
            ];
        });

        return $result;
    }

    public function getUangKeluarHome(int $userId, int $limit = 6)
    {
        return UangKeluar::with('subKategori.kategori')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function findById(int $userId, string $type, int $id)
    {
        if ($type === 'masuk') {
            $m = DB::table('uang_masuks')->where('id', $id)->where('user_id', $userId)->first();
            if (!$m) return null;
            return (object) [
                'type' => 'masuk',
                'entry_id' => $m->id,
                'description' => $m->sumber,
                'amount' => $m->jumlah,
                'tanggal' => $m->tanggal,
                'catatan' => $m->catatan,
            ];
        }

        if ($type === 'keluar') {
            $k = DB::table('uang_keluars')
                ->join('sub_kategoris', 'sub_kategoris.id', '=', 'uang_keluars.sub_kategori_id')
                ->join('kategoris', 'kategoris.id', '=', 'sub_kategoris.kategori_id')
                ->where('uang_keluars.id', $id)
                ->where('uang_keluars.user_id', $userId)
                ->select('uang_keluars.*', 'sub_kategoris.nama as sub_nama', 'kategoris.nama as kategori_nama', 'kategoris.id as kategori_id', 'sub_kategoris.id as sub_id')
                ->first();
            if (!$k) return null;
            return (object) [
                'type' => 'keluar',
                'entry_id' => $k->id,
                'description' => $k->deskripsi,
                'amount' => $k->jumlah,
                'tanggal' => $k->tanggal,
                'kategori_id' => $k->kategori_id,
                'kategori_nama' => $k->kategori_nama,
                'sub_kategori_id' => $k->sub_id,
                'sub_kategori_nama' => $k->sub_nama,
                'catatan' => $k->catatan,
            ];
        }

        if ($type === 'data') {
            $d = DB::table('data_uangs')
                ->join('kategoris', 'kategoris.id', '=', 'data_uangs.kategori_id')
                ->where('data_uangs.id', $id)
                ->where('data_uangs.user_id', $userId)
                ->select('data_uangs.*', 'kategoris.nama as kategori_nama', 'kategoris.id as kategori_id')
                ->first();
            if (!$d) return null;
            return (object) [
                'type' => 'data',
                'entry_id' => $d->id,
                'description' => $d->bulan,
                'amount' => $d->jumlah,
                'tanggal' => $d->bulan . '-01',
                'kategori_id' => $d->kategori_id,
                'kategori_nama' => $d->kategori_nama,
            ];
        }

        return null;
    }
}
