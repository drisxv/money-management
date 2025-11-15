<?php

namespace App\Services;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class KategoriService
{
    public function all(): Collection
    {
        return Kategori::orderBy('nama')->get();
    }

    public function paginate(int $perPage = 15)
    {
        return Kategori::orderBy('nama')->paginate($perPage);
    }

    public function find(int $id): Kategori
    {
        return Kategori::findOrFail($id);
    }

    public function create(array $data): Kategori
    {
        $nama = trim($data['nama'] ?? '');
        $presentase = isset($data['presentase']) ? (float)$data['presentase'] : null;
        $subKategoris = $data['sub_kategoris'] ?? null; // array of names

        if ($nama === '') {
            throw new \InvalidArgumentException('Nama kategori diperlukan.');
        }

        return DB::transaction(function () use ($nama, $presentase, $subKategoris) {
            $kategori = Kategori::create([
                'nama' => $nama,
                'presentase' => $presentase,
            ]);

            if (is_array($subKategoris) && count($subKategoris) > 0) {
                $rows = [];
                foreach ($subKategoris as $s) {
                    $sNama = trim((string)$s);
                    if ($sNama === '') {
                        continue;
                    }
                    $rows[] = [
                        'kategori_id' => $kategori->id,
                        'nama' => $sNama,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if (!empty($rows)) {
                    SubKategori::insert($rows);
                }
            }

            return $kategori->fresh();
        });
    }

    public function update(int $id, array $data): Kategori
    {
        $kategori = Kategori::findOrFail($id);

        $nama = isset($data['nama']) ? trim($data['nama']) : $kategori->nama;
        $presentase = array_key_exists('presentase', $data) ? (float)$data['presentase'] : $kategori->presentase;
        $subKategoris = $data['sub_kategoris'] ?? null; // optional replace list of names

        return DB::transaction(function () use ($kategori, $nama, $presentase, $subKategoris) {
            $kategori->update([
                'nama' => $nama,
                'presentase' => $presentase,
            ]);

            if (is_array($subKategoris)) {
                // replace existing subkategori set
                SubKategori::where('kategori_id', $kategori->id)->delete();

                $rows = [];
                foreach ($subKategoris as $s) {
                    $sNama = trim((string)$s);
                    if ($sNama === '') {
                        continue;
                    }
                    $rows[] = [
                        'kategori_id' => $kategori->id,
                        'nama' => $sNama,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if (!empty($rows)) {
                    SubKategori::insert($rows);
                }
            }

            return $kategori->fresh();
        });
    }

    public function delete(int $id): bool
    {
        $kategori = Kategori::findOrFail($id);

        return DB::transaction(function () use ($kategori) {
            SubKategori::where('kategori_id', $kategori->id)->delete();
            return (bool) $kategori->delete();
        });
    }

    public function addSubKategori(int $kategoriId, string $nama): SubKategori
    {
        $kategori = Kategori::findOrFail($kategoriId);

        $namaTrim = trim($nama);
        if ($namaTrim === '') {
            throw new \InvalidArgumentException('Nama subkategori diperlukan.');
        }

        return SubKategori::create([
            'kategori_id' => $kategori->id,
            'nama' => $namaTrim,
        ]);
    }

    public function removeSubKategori(int $subKategoriId): bool
    {
        $sub = SubKategori::findOrFail($subKategoriId);
        return (bool) $sub->delete();
    }
}
