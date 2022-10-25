<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_prod', /* 'merk_prod', 'harga_beli', 'diskon', 'stok',*/ 'harga_jual', 'kategori_id', 'ket', 'kode_prod'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penjualan_detail()
    {
        return $this->hasMany(Penjualan_detail::class);
    }
}
