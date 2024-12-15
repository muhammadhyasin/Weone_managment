<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_item_no',
        'product_name',
        'customer_name',
        'pickup_address',
        'phone_number',
        'postcode',
        'pickup_date',
        'pickup_start_time',
        'pickup_end_time',
        'price',
        'created_by',
        'updated_by',
        'pickup_status',
        'description',
    ];

    public static function countPendingPickups()
    {
        return self::where('pickup_status', 'pending')->count();
    }

    public static function countCompletedPickups()
    {
        return self::where('pickup_status', 'completed')->count();
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
        return $this->hasMany(Log::class, 'pickup_id');
    }
}
