<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_prod', /* 'merk_prod', 'harga_beli',*/ 'harga_jual', 'diskon', 'stok', 'kategori_id', 'ket', 'kode_prod'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // public function pembelian_detail()
    // {
    //     return $this->hasMany(Pembelian_detail::class);
    // }

    public function penjualan_detail()
    {
        return $this->hasMany(Penjualan_detail::class);
    }

    // public function pembelianPembelian_detail()
    // {
    //     return $this->hasOneThrough(Pembelian::class, Pembelian_detail::class);
    // }
}
