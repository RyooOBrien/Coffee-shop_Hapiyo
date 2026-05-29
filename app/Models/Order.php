<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'total',
        'payment_method',
        'status',
        'closed_at',
    ];
    protected $casts = [
    'closed_at' => 'datetime',
    ];
    public function items()
{
    return $this->hasMany(OrderItem::class);
}
}