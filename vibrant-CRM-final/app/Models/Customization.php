<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'quantity',
        'status',       // Processing, Pending Payment, Confirm Payment, Confirmed, Cancelled
        'unit_price',
        'total_price',
        'note',
        'user_id',
        'latitude',
        'longitude',
    ];

    /**
     * Define the relationship with the User model.
     * Each customization belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
