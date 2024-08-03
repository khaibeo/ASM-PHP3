@extends('Clients.layout')

@section('title', 'Đơn hàng')

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
                                <h5 class="card-header mb-3">Đơn hàng của tôi</h5>
                                @if (session('success'))
                                    <div class="alert alert-success">{{session('success')}}</div>
                                @endif
                                @foreach ($orders as $order)
                                    @php
                                        $status_text = '';
                                        $color = '';
                                        $btn = '';
                                        $btn1 = '';
                                        
                                        switch ($order->order_status) {
                                            case 'unpaid':
                                                $status_text = 'Chưa thanh toán';
                                                $color = 'bg-warning';
                                                $btn = "<a class='btn btn-gray border-dark m-3' href='" . route('user.ordercancel', ['id' => $order->id]) . "' onclick='return confirmCancelOrder(event)'>Hủy đơn hàng</a>";
                                                $btn1 = "<a class='btn btn-warning text-white m-3' href='" . route('user.orderpay', ['id' => $order->id]) . "'>Thanh toán</a>";
                                                break;
                                            case 'pending':
                                                $status_text = 'Chờ duyệt';
                                                $color = 'bg-warning';
                                                $btn = "<a class='btn btn-gray border-dark m-3' href='" . route('user.ordercancel', ['id' => $order->id]) . "' onclick='return confirmCancelOrder(event)'>Hủy đơn hàng</a>";
                                                break;
                                            case 'processing':
                                                $status_text = 'Đang xử lý';
                                                $color = 'bg-success';
                                                break;
                                            case 'shipped':
                                                $status_text = 'Đang giao hàng';
                                                $color = 'bg-warning';
                                                break;
                                            case 'delivered':
                                                $status_text = 'Đã giao thành công';
                                                $color = 'bg-success';
                                                break;
                                            case 'cancelled':
                                                $status_text = 'Đã hủy';
                                                $color = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <span>Mã đơn hàng : <a href="{{ route('user.orderdetail', $order->id) }}">{{ $order->id }}</a></span>
                                                <span class="badge {{ $color }}">{{ $status_text }}</span>
                                            </div>
                                            <div class="d-flex gap-4 align-items-center" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#orderDetails{{ $order->id }}" role="button">
                                                <div><strong>Ngày đặt</strong>: {{ $order->created_at->format('d-m-Y') }}</div>
                                                <div>{{ $order->items->count() }} sản phẩm</div>
                                                <div><strong>Tổng tiền</strong>: {{ number_format($order->total_amount, 0, ',', '.') }} đ</div>
                                                <div class="bi bi-chevron-down ms-auto"></div>
                                                <div><strong>Địa chỉ nhận</strong>: {{ $order->address}}</div>
                                            </div>
                                            <div class="collapse show mt-4" id="orderDetails{{ $order->id }}">
                                                <hr class="mb-0">
                                                
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($order->details as $item)
                                                        <div class="p-2">
                                                            <a href="#">
                                                                <img src="{{ Storage::url($item->variant->product->thumbnail) }}" class="rounded" width="80" alt="...">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="text-end mt-4">
                                                    {!! $btn !!}
                                                    {!! $btn1 !!}
                                                    <a class="btn btn-primary" href="{{ route('user.orderdetail', $order->id) }}">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function confirmCancelOrder(event) {
        event.preventDefault();
        const url = event.currentTarget.getAttribute('href');
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
            window.location.href = url;
        }
    }
</script>
@endsection
