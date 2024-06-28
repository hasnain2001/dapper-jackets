<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "slug",
        "productimage",
        "price",
        "size",
        "quantity",
        "color",
        "categories",
        'title',
        'meta_tag',
        'meta_keyword',
        'meta_description',
    
    ] ;
}
