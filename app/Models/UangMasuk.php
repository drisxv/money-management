<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UangMasuk extends Model
{
    protected $table = 'uang_masuks';

    protected $fillable = ['user_id', 'sumber', 'jumlah', 'tanggal', 'catatan'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
