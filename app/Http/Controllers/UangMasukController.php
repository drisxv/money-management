<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UangService;
use Illuminate\Support\Facades\Log;

class UangMasukController extends Controller
{
    protected UangService $uangService;

    public function __construct(UangService $uangService)
    {
        $this->middleware('auth');
        $this->uangService = $uangService;
    }

    public function create()
    {
        return view('tambah_uang_masuk');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sumber'  => 'required|string|max:255',
            'jumlah'  => 'required|numeric|min:0.01',
            'tanggal' => 'nullable|date',
            'catatan' => 'nullable|string',
        ]);

        try {
            Log::info('UangMasukController debugging - uangService class: ' . get_class($this->uangService));
            Log::info('UangMasukController debugging - has method prosesPemasukanDenganBagi: ' . (method_exists($this->uangService, 'prosesPemasukanDenganBagi') ? 'yes' : 'no'));

            $this->uangService->prosesPemasukanDenganBagi($validated);

            return redirect()->route('home')
                ->with('success', 'Pemasukan berhasil disimpan dan pembagian persentase bulan ini diperbarui.');
        } catch (\InvalidArgumentException $e) {
            return back()->withInput()
                ->withErrors(['default' => $e->getMessage()]);
        } catch (\Throwable $e) {
            Log::error('Error menyimpan uang masuk: ' . $e->getMessage());

            return back()->withInput()
                ->withErrors(['default' => 'Terjadi kesalahan saat menyimpan.']);
        }
    }
}
