<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'penjualan_aktif', 'status'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
