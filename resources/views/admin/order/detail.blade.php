@extends('admin.layout')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chi Tiết Đơn Hàng</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @session('msg')
                <div class="alert alert-success">{{session('msg')}}</div>
            @endsession
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Đơn Hàng #{{ $order->id }}</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quay Lại</a>
                                <a href="{{ route('admin.orders.print', $order->id) }}" class="btn btn-success">Hóa đơn</a>
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
                                                        alt="" class="img-fluid d-block">
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
                                    <tr class="border-top border-top-dashed">
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
                                                    {{-- <tr>
                                                        <td>Phí vận chuyển :</td>
                                                        <td class="text-end">{{ currencyFormat($order->shipping_charge)}}</td>
                                                    </tr> --}}
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Thành tiền:</th>
                                                        <th class="text-end">{{ currencyFormat($order->total_amount) }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
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
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0"><i
                                    class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Trạng thái đơn hàng
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="text-end">
                                <select class="form-select" name="order_status" id="order_status">
                                    <option value="unpaid" {{ $order->order_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Đang vận chuyển</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                @csrf
                                <button class="btn btn-primary mt-2">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end card-->

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Thông tin người nhận</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>Họ và tên: {{ $order->name }}</li>
                            <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->email }}</li>
                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->phone }}</li>
                        </ul>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
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
                <!--end card-->

                {{-- <div class="card"> --}}
                    {{-- <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                            {{$order->payment_method == 0 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online'}}</h5>
                    </div> --}}
                    {{-- <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Transactions:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">#VLZ124561278124</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Payment Method:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">Debit Card</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Card Holder Name:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">Joseph Parker</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Card Number:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Total Amount:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">$415.96</h6>
                            </div>
                        </div>
                    </div> --}}
                {{-- </div> --}}
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
@endsection
