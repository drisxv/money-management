<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangKeluar extends Model
{
    protected $table = 'uang_keluars';

    protected $fillable = ['user_id', 'kategori', 'deskripsi', 'jumlah', 'tanggal', 'catatan'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
