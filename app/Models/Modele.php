<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
