<?php

namespace App\Services;

use App\Models\UangMasuk;
use App\Models\UangKeluar;
use Illuminate\Database\Eloquent\Collection;

class UangService
{
    public function getUangMasukByUserId(int $userId): Collection
    {
        return UangMasuk::where('user_id', $userId)->get();
    }

    public function getUangKeluarByUserId(int $userId): Collection
    {
        return UangKeluar::where('user_id', $userId)->get();
    }

    public function getCashFlow(int $userId) {}
}
