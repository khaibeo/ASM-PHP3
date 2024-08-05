@extends('admin.layout')

@section('title')
    Chi tiết hóa đơn
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chi tiết hóa đơn</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hóa đơn</a></li>
                            <li class="breadcrumb-item active">Chi tiết hóa đơn</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{ asset('administrator/assets/images/logo-dark.png') }}"
                                            class="card-logo card-logo-dark" alt="logo dark" height="17">
                                        <img src="{{ asset('administrator/assets/images/logo-light.png') }}"
                                            class="card-logo card-logo-light" alt="logo light" height="17">
                                        <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Địa chỉ: </h6>
                                            <p class="text-muted mb-1" id="address-details">Phố Trịnh Văn Bô, Xuân Phương
                                                Nam Từ Liêm - Hà Nội</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h6><span class="text-muted fw-normal">Email:</span><span id="email">
                                                velzon@gmail.com</span></h6>
                                        <h6><span class="text-muted fw-normal">Website: </span> <a href="#"
                                                class="link-primary" id="website">velzon.com</a></h6>
                                        <h6 class="mb-0"><span class="text-muted fw-normal">Số điện thoại: </span><span
                                                id="contact-no"> 0346 315 304</span></h6>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-2 col-4">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Mã đơn hàng</p>
                                        <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $order->id }}</span></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-4">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Thời gian đặt</p>
                                        <h5 class="fs-14 mb-0"><span
                                                id="invoice-date">{{ $order->created_at->format('d-m-Y H:i:s') }}</span>
                                        </h5>
                                    </div>

                                    <div class="col-lg-3 col-4">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Địa chỉ nhận hàng</p>
                                        <p class="fw-medium mb-2" id="billing-name">{{ $order->name }} -
                                            {{ $order->phone }}</p>
                                        <p class="text-muted mb-1" id="billing-address-line-1">{{ $order->address }}</p>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col" class="text-end">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            @foreach ($orderItems as $item)
                                                <tr>
                                                    <th scope="row">01</th>
                                                    <td class="text-start">
                                                        <span class="fw-medium">{{ $item->product_name }}</span>
                                                        @foreach ($item->variant->attributeValues as $val)
                                                            <p class="text-muted mb-0">{{ $val->attribute->name }}: <span
                                                                    class="fw-medium">{{ $val->value }}</span></p>
                                                        @endforeach
                                                    </td>
                                                    @if ($item->product_sale_price)
                                                        <td> {{ currencyFormat($item->product_sale_price) }}
                                                            <del>{{ currencyFormat($item->product_regular_price) }}</del>
                                                        </td>
                                                    @else
                                                        <td> {{ currencyFormat($item->product_sale_price) }} </td>
                                                    @endif
                                                    <td>{{ $item->quantity }}</td>
                                                    <td class="text-end">{{ currencyFormat(($item->product_sale_price ?? $item->product_regular_price) * $item->quantity) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table><!--end table-->
                                </div>
                                <div class="border-top border-top-dashed mt-2">
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                        style="width:250px">
                                        <tbody>
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td class="text-end">{{ currencyFormat($order->total_product_price) }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Estimated Tax (12.5%)</td>
                                                <td class="text-end">$44.99</td>
                                            </tr> --}}
                                            <tr>
                                                <td>Giảm giá</td>
                                                <td class="text-end">- {{ currencyFormat($order->discount_amount) }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Shipping Charge</td>
                                                <td class="text-end">$65.00</td>
                                            </tr> --}}
                                            <tr class="border-top border-top-dashed fs-15">
                                                <th scope="row">Thành tiền</th>
                                                <th class="text-end">{{ currencyFormat($order->total_amount) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                {{-- <div class="mt-3">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                                    <p class="text-muted mb-1">Payment Method: <span class="fw-medium"
                                            id="payment-method">Mastercard</span></p>
                                    <p class="text-muted mb-1">Card Holder: <span class="fw-medium"
                                            id="card-holder-name">David Nichols</span></p>
                                    <p class="text-muted mb-1">Card Number: <span class="fw-medium" id="card-number">xxx
                                            xxxx xxxx 1234</span></p>
                                    <p class="text-muted">Total Amount: <span class="fw-medium" id="">$
                                        </span><span id="card-total-amount">755.96</span></p>
                                </div> --}}
                                {{-- <div class="mt-4">
                                    <div class="alert alert-info">
                                        <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                            <span id="note">All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or
                                                credit card or direct payment online. If account is not paid within 7
                                                days the credits details supplied as confirmation of work undertaken
                                                will be charged the agreed quoted fee noted above.
                                            </span>
                                        </p>
                                    </div>
                                </div> --}}
                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <a href="javascript:window.print()" class="btn btn-success"><i
                                            class="ri-printer-line align-bottom me-1"></i> In hóa đơn</a>
                                    {{-- <a href="javascript:void(0);" class="btn btn-primary"><i
                                            class="ri-download-2-line align-bottom me-1"></i> Download</a> --}}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/invoicedetails.js') }}"></script>
@endsection
