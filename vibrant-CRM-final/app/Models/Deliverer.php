<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverer extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',       // Foreign key referencing the orders table
        'deliverer_name', // Name of the deliverer
        'delivery_status', // Status of delivery (Pending, In Transit, Delivered, Canceled)
        'delivery_note',  // Optional note about the delivery
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
