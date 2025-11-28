<?php

namespace App\Services;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KategoriService
{
    /**
     * Mengambil semua data kategori.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        // Menambahkan log saat mengambil semua data kategori
        Log::info('Mengambil semua data kategori.');

        return Kategori::orderBy('id')->get();
    }

    /**
     * Update persentase kategori berdasarkan id.
     *
     * @param int $id
     * @param array $data
     * @return Kategori
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): Kategori
    {
        // Validasi: apakah data yang diperlukan ada dan dapat dikonversi menjadi integer
        if (!isset($data['persentase']) || !is_numeric($data['persentase'])) {
            Log::error('Persentase invalid', ['id' => $id, 'data' => $data]);
            throw new \InvalidArgumentException('Persentase harus diberikan dalam format numerik.');
        }

        // Cast ke integer (terima nilai numerik sebagai string juga)
        $persentase = (int) $data['persentase'];

        // Validasi rentang persentase (opsional, 0-100)
        if ($persentase < 0 || $persentase > 100) {
            Log::error('Persentase di luar rentang', ['id' => $id, 'persentase' => $persentase]);
            throw new \InvalidArgumentException('Persentase harus berada di antara 0 dan 100.');
        }

        // Cari kategori berdasarkan ID
        $kategori = Kategori::find($id);

        // Jika kategori tidak ditemukan, lemparkan exception
        if (!$kategori) {
            Log::warning("Kategori dengan ID {$id} tidak ditemukan.");
            throw new ModelNotFoundException("Kategori dengan ID {$id} tidak ditemukan.");
        }

        return DB::transaction(function () use ($kategori, $data, $id, $persentase) {
            Log::info('Memperbarui persentase kategori.', ['id' => $id, 'persentase' => $data['persentase']]);

            $kategori->update([
                'persentase' => $persentase
            ]);

            Log::info('Persentase kategori berhasil diperbarui.', ['id' => $id, 'new_persentase' => $persentase]);

            return $kategori->fresh(); 
        });
    }

    public function updateMultiple(array $persentases)
    {
        $ids = [1, 2, 3];

        $total = 0;
        foreach ($ids as $id) {
            if (!isset($persentases[$id]) && !isset($persentases[(string)$id])) {
                Log::error('Persentase untuk id tidak tersedia', ['missing_id' => $id, 'input' => $persentases]);
                throw new \InvalidArgumentException("Persentase untuk id {$id} harus diberikan.");
            }

            $val = isset($persentases[$id]) ? $persentases[$id] : $persentases[(string)$id];

            if (!is_numeric($val)) {
                Log::error('Persentase invalid (batch)', ['id' => $id, 'value' => $val]);
                throw new \InvalidArgumentException('Semua persentase harus berupa angka.');
            }

            $persentases[$id] = (int) $val;
            $total += $persentases[$id];
        }

        if ($total !== 100) {
            Log::error('Total persentase batch tidak 100', ['total' => $total, 'data' => $persentases]);
            throw new \InvalidArgumentException('Total persentase harus bernilai 100%.');
        }

        return DB::transaction(function () use ($persentases, $ids) {
            $updated = [];
            foreach ($ids as $id) {
                $kategori = Kategori::find($id);
                if (!$kategori) {
                    Log::warning("Kategori id {$id} tidak ditemukan saat batch update.");
                    throw new ModelNotFoundException("Kategori dengan ID {$id} tidak ditemukan.");
                }

                $kategori->update(['persentase' => $persentases[$id]]);
                $updated[] = $kategori->fresh();
            }

            return collect($updated);
        });
    }
}
