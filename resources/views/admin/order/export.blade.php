@extends('admin.layout')

@section('title')
    Export đơn hàng
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> Export đơn hàng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">Export đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card" id="orderList">
            <div class="card-header border-0">
                <div class="row align-orders-center gy-3">
                    <div class="col-sm">
                        <h5 class="card-title mb-0">Chọn tiêu chí lọc</h5>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form method="GET" action="{{ route('admin.orders.index') }}">
                    <div class="row g-3">
                        <div class="col-xxl-3 col-sm-6">
                            <div>
                                <input type="text" class="form-control" name="date" data-provider="flatpickr"
                                    data-date-format="d-m-Y" data-range-date="true" id="demo-datepicker"
                                    placeholder="Chọn Ngày">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-sm-4">
                            <div>
                                <select class="form-control" name="status" id="order_status">
                                    <option value="all" selected>Trạng thái</option>
                                    <option value="pending">Chờ duyệt</option>
                                    <option value="processing">Đang chuẩn bị</option>
                                    <option value="shipped">Đang giao hàng</option>
                                    <option value="delivered">Đã giao</option>
                                    <option value="cancelled">Đã hủy</option>
                                    <option value="unpaid">Chưa thanh toán</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-4 col-sm-4">
                            <div>
                                <select class="form-control" name="payment" id="payment">
                                    <option value="all" selected>Phương thức thanh toán</option>
                                    <option value="0">COD</option>
                                    <option value="1">VNPay</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-sm-6">
                            <div>
                                <input type="text" class="form-control" name="min"
                                    placeholder="Giá trị đơn hàng tối thiểu">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-sm-6">
                            <div>
                                <input type="text" class="form-control" name="max"
                                    placeholder="Giá trị đơn hàng tối đa">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-2 col-sm-4">
                            <div>
                                <button type="button" id="btn-export" class="btn btn-primary w-100"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Xuất
                                </button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>

                <div id="message-container" class="mt-3" style="display: none;">
                    <div class="alert" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const btnExport = document.getElementById('btn-export');
            const messageContainer = document.getElementById('message-container');
            const messageAlert = messageContainer.querySelector('.alert');

            function showMessage(message, type = 'error') {
                messageAlert.textContent = message;
                messageAlert.className = `alert alert-${type === 'error' ? 'danger' : 'success'}`;
                messageContainer.style.display = 'block';
            }

            btnExport.addEventListener('click', async function() {
                const date = document.querySelector('input[name="date"]').value;
                const status = document.getElementById('order_status').value;
                const payment = document.getElementById('payment').value;
                const min = document.querySelector('input[name="min"]').value;
                const max = document.querySelector('input[name="max"]').value;

                const params = new URLSearchParams({
                    date: date,
                    status: status,
                    payment: payment,
                    min: min,
                    max: max
                });

                // Loại bỏ các tham số trống
                for (const [key, value] of params.entries()) {
                    if (!value) {
                        params.delete(key);
                    }
                }

                const url = `/api/orders/export?${params.toString()}`;

                // Hiển thị thông báo "Đang xử lý..."
                showMessage('Đang xử lý yêu cầu xuất dữ liệu...', 'info');

                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (result.success && result.file_url) {
                        const link = document.createElement('a');
                        link.href = result.file_url;
                        link.download = result.file_name;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        showMessage('Xuất dữ liệu thành công!', 'success');
                    } else {
                        throw new Error(result.message || 'Không thể xuất dữ liệu');
                    }
                } catch (error) {
                    showMessage(`Có lỗi xảy ra: ${error.message}`);
                }
            });
        });
    </script>
@endsection
