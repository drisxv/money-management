<?php

namespace App\Services;

use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SubKetegoriService
{
    public function all(): Collection
    {
        return SubKategori::orderBy('nama')->get();
    }

    public function paginate(int $perPage = 15)
    {
        return SubKategori::orderBy('nama')->paginate($perPage);
    }

    public function find(int $id): SubKategori
    {
        return SubKategori::findOrFail($id);
    }

    public function create(array $data): SubKategori
    {
        $nama = trim($data['nama'] ?? '');
        $kategoriId = isset($data['kategori_id']) ? (int)$data['kategori_id'] : null;

        if ($nama === '') {
            throw new \Exception('Nama subkategori diperlukan.');
        }
        if ($kategoriId === null) {
            throw new \Exception('Kategori ID diperlukan.');
        }

        return SubKategori::create([
            'nama' => $nama,
            'kategori_id' => $kategoriId,
        ]);
    }

    public function update(int $id, array $data): SubKategori
    {
        $subKategori = $this->find($id);

        $nama = trim($data['nama'] ?? '');
        $kategoriId = isset($data['kategori_id']) ? (int)$data['kategori_id'] : null;

        if ($nama === '') {
            throw new \Exception('Nama subkategori diperlukan.');
        }
        if ($kategoriId === null) {
            throw new \Exception('Kategori ID diperlukan.');
        }

        $subKategori->nama = $nama;
        $subKategori->kategori_id = $kategoriId;
        $subKategori->save();

        return $subKategori;
    }

    public function delete(int $id): void
    {
        $subKategori = $this->find($id);
        $subKategori->delete();
    }
}
