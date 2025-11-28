<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubKetegoriService;
use App\Models\Kategori;
use Illuminate\Support\Facades\Redirect;

class SubKategoriController extends Controller
{
    protected SubKetegoriService $service;

    public function __construct(SubKetegoriService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        return view('tambah_sub_kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'integer', 'exists:kategoris,id'],
        ]);

        try {
            $this->service->create($data);
            return Redirect::route('kategori')->with('success', 'Sub kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(int $id)
    {
        $sub = $this->service->find($id);
        $kategoris = Kategori::orderBy('nama')->get();
        return view('tambah_sub_kategori', compact('sub', 'kategoris'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'integer', 'exists:kategoris,id'],
        ]);

        try {
            $this->service->update($id, $data);
            return Redirect::route('kategori')->with('success', 'Sub kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);
            return Redirect::route('kategori')->with('success', 'Sub kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
