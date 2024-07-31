@extends('Clients.layout')
@section('title')
Chi tiết đơn hàng
@endsection
@section('content')
<main>
    <div class="container margin_30">
        <div class="layout-wrapper">
            <div class="content">
                <div class="row flex-column-reverse flex-md-row">
                    @include('Clients.account.sidebar')
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-header mb-3">Chi tiết đơn hàng</h5>
                                <div class='card mb-4'>
                                    <div class='card-body'>
                                        {{-- <div class='mb-4 d-flex align-items-center justify-content-between'>
                                            <span>Mã đơn hàng: <a href='#'>{{ $order->id }}</a></span>
                                            <span class='badge {{ $order->color }}'>{{ $order->status_text }}</span>
                                        </div>
                                        <div class='d-flex gap-4 align-items-center'>
                                            <div><strong>Ngày đặt:</strong> {{ $order->created_at }}</div>
                                            <div>{{ $order->total_items }} món</div>
                                            <div><strong>Tổng tiền:</strong> {{ $order->total }}</div>
                                        </div> --}}

                                        <div class='table-responsive mt-4'>
                                            <table class='table table-custom mb-0'>
                                                <thead>
                                                    <tr>
                                                        <th>Ảnh</th>
                                                        <th>Tên</th>
                                                        <th>Size</th>
                                                        <th>Màu</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá</th>
                                                        <th>Tổng tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($order as $detail)
                                                        <tr>
                                                            <td>
                                                                <a href='#'>
                                                                    <img src='{{asset('storage/' . $detail->thumbnail)}}' class='rounded' width='40' alt='...'>
                                                                </a>
                                                            </td>
                                                            <td><a href='#'>{{ $detail->name }}</a></td>
                                                            <td>{{ $detail->value }}</td>
                                                            <td>{{ $detail->value}}</td>
                                                            <td>{{ $detail->quantity }}</td>
                                                            <td>{{ $detail->product_sale_price }}</td>
                                                            <td>{{ $detail->product_sale_price * $detail->quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class='text-end'>
                                            <a class='btn btn-primary m-3' href='{{ route('user.order') }}'>Quay lại danh sách đơn hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
