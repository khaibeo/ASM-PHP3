@extends('Clients.layout')
@section('title')
Chi tiết đơn hàng
@endsection
@section('content')
<main>
    <div class="row" style="padding-top: 30px ; padding-bottom: 50px ;">
       
        <div class="col-xl-9" style="width: 60%; margin-left:10%">
            <div class="card" >
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Đơn Hàng #{{ $order->id }} - {{getOrderStatus($order->order_status)}}</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('user.order') }}" class="btn btn-success">Quay Lại</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Thời gian đặt hàng: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s')  }}</p>
                        <p>Phương thức thanh toán: {{ $order->payment_method == 0 ? 'Thanh toán khi nhận hàng' : 'Thanh toán Online' }}</p>
                        <p>Ghi chú: {{ $order->name }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div>
    
                    </div>
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số Lượng</th>
                                    <th scope="col">Mã Sản Phẩm</th>
                                    <th scope="col" class="text-end">Tổng Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="{{ Storage::url($item->variant->product->thumbnail) }}"
                                                    alt="" class="img-fluid d-block" width="150px" height="150px">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a href="{{ route('admin.products.edit', $item->variant->product->id) }}"
                                                        class="link-primary">{{ $item->product_name }}</a></h5>
                                                @foreach ($item->variant->attributeValues as $val)
                                                    <p class="text-muted mb-0">{{$val->attribute->name}}: <span class="fw-medium">{{ $val->value }}</span></p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    @if ($item->product_sale_price)
                                        <td> {{ currencyFormat($item->product_sale_price) }} <del>{{ currencyFormat($item->product_regular_price) }}</del> </td>
                                    @else
                                        <td> {{ currencyFormat($item->product_sale_price) }} </td>
                                    @endif
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        {{ $item->product_sku }}
                                    </td>
                                    <td class="fw-medium text-end">
                                        {{ currencyFormat(($item->product_sale_price ?? $item->product_regular_price) * $item->quantity) }}
                                    </td>
                                </tr>
                                @endforeach
                                {{-- <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Tổng tiền sản phẩm :</td>
                                                    <td class="text-end">{{ currencyFormat($order->total_product_price) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Giảm giá <span class="text-muted"> :</td>
                                                    <td class="text-end">{{ currencyFormat($order->discount_amount) }}</td>
                                                </tr>
                                                
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Thành tiền:</th>
                                                    <th class="text-end">{{ currencyFormat($order->total_amount) }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">
            
            <div class="card" style="width: 80%; margin-right:10%">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Thông tin người nhận</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>{{ $order->name }}</li>
                        <li>{{ $order->email }}</li>
                        <li>{{ $order->phone }}</li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card" style="width: 80%; margin-right:10%;margin-top:20px">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Địa chỉ nhận hàng</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{ $order->name }}</li>
                        <li>{{ $order->phone }}</li>
                        <li>{{ $order->address }}</li>
                    </ul>
                </div>
            </div>
            <div class="card" style="width: 80%; margin-right:10%;margin-top:20px">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Tổng tiền</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li >Tổng tiền: {{ currencyFormat($order->total_product_price) }}</li>
                        <li> Giảm giá: {{ currencyFormat($order->discount_amount) }}</li>
                        <li class="fw-bold fs-14">Thành tiền: {{ currencyFormat($order->total_amount) }}</li>
                    </ul>
                </div>
            </div>
            <!--end card-->
    
            
        </div>
        <!--end col-->
    </div>
</main>
@endsection
