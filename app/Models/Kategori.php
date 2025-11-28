<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = ['nama', 'persentase'];

    public function subKategoris()
    {
        return $this->hasMany(SubKategori::class);
    }
}
