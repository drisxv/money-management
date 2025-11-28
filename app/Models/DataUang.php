<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUang extends Model
{
    protected $table = 'data_uangs';
    protected $fillable = ['user_id', 'bulan', 'jumlah', 'persentase', 'kategori_id'];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
