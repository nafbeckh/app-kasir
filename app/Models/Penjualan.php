<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'meja_id', 'waiters_id', 'kasir_id', 'total_item', 'total_harga', 'bayar', 'diterima', 'status'
    ];

    public function penjualan_detail()
    {
        return $this->hasMany(Penjualan_detail::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function waiters()
    {
        return $this->belongsTo(User::class, 'waiters_id');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
