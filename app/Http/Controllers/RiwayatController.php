<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RiwayatService;
use App\Models\Kategori;

class RiwayatController extends Controller
{
    protected $riwayatService;

    public function __construct(RiwayatService $riwayatService)
    {
        $this->riwayatService = $riwayatService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $filters = $request->only(['start_date', 'end_date', 'tipe', 'kategori_id']);
        $perPage = (int) $request->input('per_page', 15);
        $riwayat = $this->riwayatService->fetchRiwayat($user->id, $filters, $perPage);
        $kategoris = Kategori::all();
        return view('riwayat', compact('user', 'riwayat', 'filters', 'kategoris'));
    }

    public function show($type, $id)
    {
        $user = Auth::user();
        $entry = $this->riwayatService->findById($user->id, $type, (int) $id);
        if (!$entry) {
            abort(404);
        }
        return view('detail_riwayat', compact('entry'));
    }
}
