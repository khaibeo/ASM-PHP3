<?php 
function currencyFormat($value){
    return number_format($value, 0, ',', '.') . ' đ';
}

function getOrderStatus($status){
    $listStatus = [
        'unpaid' => 'Chưa thanh toán',
        'pending' => 'Chờ duyệt',
        'processing' => 'Đang chuẩn bị hàng',
        'shipped' => 'Đang vận chuyển',
        'delivered' => 'Đã giao',
        'cancelled' => 'Đã hủy',
    ];
    return $listStatus[$status];
}