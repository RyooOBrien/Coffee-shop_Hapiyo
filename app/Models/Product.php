<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'discount',
        'best_seller',
        'stock',
        'description',
        'image',
    ];
}