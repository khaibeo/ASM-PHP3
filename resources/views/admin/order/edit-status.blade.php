@extends('admin.layout')

@section('title')
    Sửa Trạng Thái Đơn Hàng
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sửa Trạng Thái Đơn Hàng</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sửa Trạng Thái Đơn Hàng</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="order_status" class="form-label">Trạng Thái Đơn Hàng</label>
                                <select class="form-control" id="order_status" name="order_status">
                                    <option value="unpaid" {{ $order->order_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Đang vận chuyển</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
