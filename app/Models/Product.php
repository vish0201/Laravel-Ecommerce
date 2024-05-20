<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'cat_id', 'images'];

    protected $casts = [
        'images' => 'array', // Cast images attribute to array
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class , 'cat_id');
    }
}
