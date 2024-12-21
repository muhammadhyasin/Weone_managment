<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;
    protected $fillable = [
        'product_item_no',
        'product_name',
        'customer_name',
        'address',
        'phone_number',
        'postcode',
        'delivery_date',
        'delivery_start_time',
        'delivery_end_time',
        'price',
        'created_by',
        'updated_by',
        'order_status',
        'payment_method',      
        'payment_status',
        'advance_amount', 
        'description',
        'card_payment',
        'cash_payment',
    ];
    public static function countPendingOrders()
    {
        return self::where('order_status', 'pending')->count();
    }
    public static function countRefundOrders()
    {
        return self::where('order_status', 'refunded')->count();
    }
    public static function countCancelledOrders()
    {
        return self::where('order_status', 'Cancelled')->count();
    }
    public static function countCompleteOrders()
    {
        return self::where('order_status', 'Completed')->count();
    }
    

   
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function logs()
    {
        return $this->hasMany(Log::class);
    }



    
  
}
