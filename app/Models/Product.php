<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Pastikan Kategori diawali huruf KAPITAL 'K' sesuai nama kolom database
    protected $fillable = ['name', 'price', 'description', 'stock', 'Kategori'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'Kategori', 'id');
    }
}