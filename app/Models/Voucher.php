<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'max_discount_value',
        'quantity',
        'valid_from',
        'valid_until',
        'min_order_value',
        'max_order_value',
        'display_status',
    ];

    static public function getAll()
    {
        return self::select('vouchers.*')->get();
    }
    static public function getAllClient()
    {
        $today = now()->format('Y-m-d');
        return self::select('vouchers.*')
            ->where('display_status', '=', 1)
            ->where('valid_until', '>=', $today)
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
}
