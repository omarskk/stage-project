<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand_id', 'modele_id', 'category_id', 'price', 'quantity','type'

    ];
    // Product.php
public function brand()
{
    return $this->belongsTo(Brand::class);
}

public function modele()
{
    return $this->belongsTo(Modele::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

} 