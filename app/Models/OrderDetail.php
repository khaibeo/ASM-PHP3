<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }
}
