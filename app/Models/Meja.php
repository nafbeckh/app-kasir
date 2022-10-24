<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_meja', 'nama', 'status'
    ];

    public function penjualan()
    {
        return $this->hasOne(Penjualan::class);
    }
}
