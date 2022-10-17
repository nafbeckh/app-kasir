<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kat'
    ];
    public function produk(){
        return $this->hasOne(Produk::class);
    }
}
