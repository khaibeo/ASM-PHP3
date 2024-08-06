<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrderExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Người nhận',
            'Email',
            'Số điện thoại',
            'Địa chỉ',
            'Phương thức thanh toán',
            'Trạng thái đơn hàng',
            'Tổng tiền sản phẩm',
            'Giảm giá',
            'Thành tiền',
            'Thời gian đặt'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->name,
            $order->email,
            $order->phone,
            $order->address,
            $order->payment_method == 0 ? 'COD' : 'VNPay',
            getOrderStatus($order->order_status),
            $order->total_product_price,
            $order->discount_amount,
            $order->total_amount,
            Date::dateTimeToExcel($order->created_at)
        ];
    }
}
