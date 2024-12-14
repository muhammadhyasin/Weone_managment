<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'action',
        'pickup_id',
    ];
    public static function record($data)
    {
        // Prevent logging if the user is a superadmin
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return; // Skip logging
        }

        static::create($data);
    }



    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


