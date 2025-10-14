<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanUser extends Model
{
    protected $table = 'pengaturan_user';

    protected $fillable = ['user_id', 'living', 'saving', 'playing', 'tanggal_gajian'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
