<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_day_salary',
        'half_day_salary',
        'shift_start_time',
        'shift_end_time',
        'joining_date',
    ];

    protected $casts = [
        'shift_start_time' => 'datetime:H:i',
        'shift_end_time' => 'datetime:H:i',
        'joining_date' => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
