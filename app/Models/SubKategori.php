<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    protected $table = 'sub_kategoris';

    protected $fillable = ['kategori_id', 'nama'];
}
