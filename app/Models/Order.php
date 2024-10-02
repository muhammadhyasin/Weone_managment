<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    
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
    ];

   
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    
  
}
