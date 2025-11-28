<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\KategoriService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    private KategoriService $service;

    public function __construct(KategoriService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $kategoris = $this->service->all();
        $subKategoris = \App\Models\SubKategori::with('kategori')->orderBy('nama')->get();

        return view('kategori', compact('kategoris', 'subKategoris'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'persentase' => 'required|integer'
        ]);

        try {
            $this->service->update($id, $data);
            return redirect()->route('kategori')->with('success', 'Persentase diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('kategori')->with('error', $e->getMessage());
        }
    }

    public function updateMultiple(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'persentase.1' => 'required|integer',
            'persentase.2' => 'required|integer',
            'persentase.3' => 'required|integer',
        ]);

        $pers = $request->input('persentase', []);
        $sum = array_sum($pers);

        if ($sum !== 100) {
            return redirect()->route('kategori')->with('error', 'Total persentase harus 100%.');
        }

        try {
            $this->service->updateMultiple($pers);
            return redirect()->route('kategori')->with('success', 'Persentase diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('kategori')->with('error', $e->getMessage());
        }
    }
}
