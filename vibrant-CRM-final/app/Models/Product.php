<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Add the category_name to the fillable fields
    protected $fillable = [
        'name',
        'description',
        'item_price',
        'quantity',
        'status',
        'image',
        'category_id',
        'category_name'
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
