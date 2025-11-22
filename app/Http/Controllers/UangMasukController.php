<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UangService;

class UangMasukController extends Controller
{
    protected UangService $uangService;

    public function __construct(UangService $uangService)
    {
        $this->middleware('auth');
        $this->uangService = $uangService;
    }

    // Tampilkan form tambah pemasukan
    public function create()
    {
        return view('tambah_uang_masuk');
    }

    // Simpan pemasukan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sumber' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0.01',
            'tanggal' => 'nullable|date',
            'catatan' => 'nullable|string',
        ]);

        try {
            $this->uangService->storeUangMasuk($request->user()->id, $validated);
            return redirect()->route('home')->with('success', 'Pemasukan berhasil disimpan.');
        } catch (\InvalidArgumentException $e) {
            return back()->withInput()->withErrors(['default' => $e->getMessage()]);
        } catch (\Throwable $e) {
            \Log::error('Error menyimpan uang masuk: ' . $e->getMessage());
            return back()->withInput()->withErrors(['default' => 'Terjadi kesalahan saat menyimpan.']);
        }
    }
}
