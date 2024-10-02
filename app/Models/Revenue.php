<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',     // Revenue amount
        'source',     // Source of the revenue
        'order_id',   // Associated order ID
    ];

    /**
     * Define the relationship with the Order model.
     */
    public static function totalRevenue()
    {
        return self::sum('amount');
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
