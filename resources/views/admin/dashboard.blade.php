@extends('admin.layout')

@section('title')
    Bảng điều khiển
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Xin chào, {{ Auth::user()->name }}!</h4>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <div class="col-auto">
                                        <a href="{{ route('admin.products.add') }}" class="btn btn-soft-success"><i
                                                class="ri-add-circle-line align-middle me-1"></i> Thêm sản phẩm</a>
                                    </div>
                                    <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="fw-medium text-muted text-truncate mb-0">Chờ duyệt</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $pendingOrders }}">0</span></h4>
                                            <a href="{{ route('admin.orders.index') . '?status=pending' }}"
                                                class="text-decoration-underline">Xem tất cả</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-dollar-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="fw-medium text-muted text-truncate mb-0">Đang chuẩn bị</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $processingOrders }}">0</span></h4>
                                            <a href="{{ route('admin.orders.index') . '?status=processing' }}"
                                                class="text-decoration-underline">Xem tất cả</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="fw-medium text-muted text-truncate mb-0">Đang vận chuyển</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $shippedOrders }}">0</span> </h4>
                                            <a href="{{ route('admin.orders.index') . '?status=shipped' }}"
                                                class="text-decoration-underline">Xem tất cả</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-user-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="fw-medium text-muted text-truncate mb-0"> Hoàn tất
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $completedOrders }}">0</span> </h4>
                                            <a href="{{ route('admin.orders.index') . '?status=delivered' }}"
                                                class="text-decoration-underline">Xem tất cả</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <i class="bx bx-wallet text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-info btn-sm">
                                            <i class="ri-file-list-3-line align-middle"></i> Xem tất cả
                                        </a>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Tên khách hàng</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Tổng tiền</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Thời gian đặt</th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentOrders as $order)
                                                    <tr>
                                                        <td>
                                                            <a href="apps-ecommerce-order-details.html"
                                                                class="fw-medium link-primary">#{{ $order->id }}</a>
                                                        </td>
                                                        <td>{{ $order->name }}</td>
                                                        <td>{{ $order->phone }}</td>
                                                        <td>
                                                            <span
                                                                class="text-success">{{ currencyFormat($order->total_amount) }}</span>
                                                        </td>
                                                        <td>
                                                            {{ getOrderStatus($order->order_status) }}
                                                        </td>
                                                        <td>
                                                            {{ $order->created_at->format('H:i d/m/Y') }}
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.orders.detail',$order->id)}}" class="btn btn-primary">Chi tiết</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượt bán</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bestSellingProducts as $item)
                                                    <tr>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $item->id . ' - ' . $item->sku}}</h5>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ \Storage::url($item->thumbnail) }}"
                                                                        alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a
                                                                            href="{{ route('admin.products.edit', $item->id) }}"
                                                                            class="text-reset">{{$item->name}}</a></h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{$item->total_sell}}</h5>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end .h-100-->
            </div> <!-- end col -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('administrator/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection
