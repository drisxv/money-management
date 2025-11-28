<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangKeluar extends Model
{
    protected $table = 'uang_keluars';

    protected $fillable = ['user_id', 'sub_kategori_id', 'deskripsi', 'jumlah', 'tanggal', 'catatan'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class);
    }

    public function kategori()
    {
        return $this->hasOneThrough(Kategori::class, SubKategori::class, 'id', 'id', 'sub_kategori_id', 'kategori_id');
    }
}
