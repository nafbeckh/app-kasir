<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'meja_id', 'user_id', 'total_item', 'total_harga', 'bayar', 'diterima', 'status', 'kode_penj'
    ];

    public function penjualan_detail()
    {
        return $this->hasMany(Penjualan_detail::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
