@extends('admin.layout')

@section('title')
    Sửa mã giảm giá
@endsection

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa mã giảm giá</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mã giảm giá</a></li>
                        <li class="breadcrumb-item active">Sửa mã giảm giá</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.vouchers.edit', $voucher->id) }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Tên mã giảm giá</label>
                            <input type="text" name="name" value="{{ old('name', $voucher->name) }}" class="form-control" id="project-title-input">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Mô tả</label>
                            <input type="text" name="description" value="{{ old('description', $voucher->description) }}" class="form-control" id="project-title-input">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Mã code</label>
                            <input type="text" name="code" value="{{ old('code', $voucher->code) }}" class="form-control" id="project-title-input">
                            @error('code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="choices-priority-input" class="form-label">Loại giảm giá</label>
                                    <select class="form-select" name="discount_type">
                                        <option value="0" {{ old('discount_type', $voucher->discount_type) == 0 ? 'selected' : '' }}>Số lượng</option>
                                        <option value="1" {{ old('discount_type', $voucher->discount_type) == 1 ? 'selected' : '' }}>Phần trăm</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="choices-status-input" class="form-label">Giá trị giảm</label>
                                    <input type="number" name="discount_value" value="{{ old('discount_value', $voucher->discount_value) }}" class="form-control">
                                    @error('discount_value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="datepicker-deadline-input" class="form-label">Số lượng</label>
                                    <input type="number" name="quantity" value="{{ old('quantity', $voucher->quantity) }}" class="form-control">
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="min-order-value-input" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                    <input type="number" name="min_order_value" class="form-control" value="{{ old('min_order_value', $voucher->min_order_value) }}">
                                    @error('min_order_value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="max-order-value-input" class="form-label">Giá trị đơn hàng tối đa</label>
                                    <input type="number" name="max_order_value" class="form-control" value="{{ old('max_order_value', $voucher->max_order_value) }}">
                                    @error('max_order_value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="max-discount-value-input" class="form-label">Giá trị giảm giá tối đa</label>
                                    <input type="number" name="max_discount_value" class="form-control" value="{{ old('max_discount_value', $voucher->max_discount_value) }}">
                                    @error('max_discount_value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3 mt-4">
                            <div class="form-check form-switch form-switch-md">
                                <!-- Không cần input hidden nếu bạn xử lý giá trị checkbox đúng cách -->
                                <input type="checkbox" class="form-check-input" id="is-visible-switch" name="display_status" value="0" {{ old('display_status', $voucher->display_status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is-visible-switch">Hiển thị</label>
                                @error('display_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="text-end mb-4">
                    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-danger w-sm">Quay lại</a>
                    <button type="submit" class="btn btn-success w-sm">Cập nhật</button>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thời gian</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="valid_from" class="form-label">Thời gian bắt đầu</label>
                            <input class="form-control" name="valid_from" value="{{ old('valid_from', $voucher->valid_from) }}" id="valid_from" type="date" />
                            @error('valid_from')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="valid_until" class="form-label">Thời gian kết thúc</label>
                            <input class="form-control" name="valid_until" value="{{ old('valid_until', $voucher->valid_until) }}" id="valid_until" type="date" />
                            @error('valid_until')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </form>
    <!-- end row -->

</div>
<!-- container-fluid -->
@endsection

@section('scripts')
    <!-- project-create init -->
    <script src="{{ asset('administrator/assets/js/pages/project-create.init.js') }}"></script>
@endsection
