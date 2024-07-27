<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    static public function getAll(){
        return self::select('orders.*', 'users.name as user_name', 'pays.name as pay_name')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('pays', 'orders.payment_method', '=', 'pays.id')
            ->get();
    }

    static public function getSingle($id){
        return self::with('orderDetails')->find($id);
    }
}
