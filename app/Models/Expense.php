<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',    // e.g., diesel, cleaning supplies, maintenance, other
        'amount',      // Negative value representing the expense
        'description', // Details of the expense
        'created_by',  // The user who created the expense entry
    ];

    // Relationship to User (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Define categories
    public static function categories()
    {
        return [
            'diesel',
            'cleaning supplies',
            'maintenance',
            'other',
        ];
    }

    // Automatically store expense as a negative value
    // public function setAmountAttribute($value)
    // {
    //     $this->attributes['amount'] = -abs($value); // Always negative
    // }
    public static function getTotalExpenses()
    {
        // Sum all the expenses
        return self::sum('amount');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by'); // Assuming 'created_by' is the foreign key in the expenses table
    }

}
