<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id', 'total_item', 'total_harga', 'diskon', 'bayar', 'kode_pemb'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function pembelian_detail()
    {
        return $this->hasMany(Pembelian_detail::class);
    }

    // public function pembelian_detail()
    // {
    //     return $this->hasManyThrough( Pembelian_detail::class,Produk::class);
    // }

    public function produk()
    {
        return $this->hasManyThrough(Produk::class, Pembelian_detail::class);
    }
}
