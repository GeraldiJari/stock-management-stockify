<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'purchase_price',
        'selling_price',
        'image',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id'); // Ganti 'category_id' dengan nama kolom yang sesuai jika berbeda
    }
}
