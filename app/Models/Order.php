<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // ⬇️ Ini yang kamu butuhkan untuk mass assignment
    protected $fillable = [
        'user_id',
        'status',
        'notified_seller',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        return $this->belongsTo(\App\Models\User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
