<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_number',
        'customer_name',
        'phone',
        'address',
        'total',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id',
            'order_id'
        );
    }
}