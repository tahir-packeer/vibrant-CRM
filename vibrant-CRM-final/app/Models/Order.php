<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'product_id',
        'user_name',
        'user_address',
        'product_qty',
        'order_status',
        'payment_status',
        'order_price',
    ];

    /**
     * Relationship to the Product model
     * Each order is associated with one product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship to the User model
     * Each order is associated with one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliverer()
    {
        return $this->hasOne(Deliverer::class, 'order_id');
    }

}
