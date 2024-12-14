<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class uLog extends Model
{
    protected $fillable = ['user_id', 'action', 'module', 'details'];

    public static function record($action, $module = null, $details = null)
    {
        static::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => $module,
            'details' => $details,
        ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
