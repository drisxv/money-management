<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UangService;
use Illuminate\Support\Facades\Response;
class UangKeluarController extends Controller
{
	protected UangService $uangService;

	public function __construct(UangService $uangService)
	{
		$this->uangService = $uangService;
	}

	public function store(Request $request)
	{
		$request->validate([
			'sub_kategori_id' => 'required|exists:sub_kategoris,id',
			'deskripsi' => 'required|string|max:255',
			'jumlah' => 'required|string',
			'tanggal' => 'nullable|date',
			'catatan' => 'nullable|string',
		]);

		try {
			$uangKeluar = $this->uangService->prosesPengeluaran($request->only([
				'sub_kategori_id',
				'deskripsi',
				'jumlah',
				'tanggal',
				'catatan',
			]));

			return redirect()->route('home')->with('success', 'Pengeluaran berhasil disimpan dan alokasi dikurangi.');
		} catch (\Exception $e) {
			return back()->withErrors(['error' => $e->getMessage()])->withInput();
		}
	}

	public function preview(Request $request)
	{
		$request->validate([
			'sub_kategori_id' => 'required|exists:sub_kategoris,id',
			'jumlah' => 'required',
			'tanggal' => 'nullable|date',
		]);

		try {
			$result = $this->uangService->previewPengeluaran($request->only(['sub_kategori_id', 'jumlah', 'tanggal']));
			return Response::json($result);
		} catch (\Exception $e) {
			return Response::json(['error' => $e->getMessage()], 400);
		}
	}

}
