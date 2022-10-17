<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembelian_id', 'produk_id', 'harga_beli', 'jumlah', 'subtotal'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
