@extends('admin.layout')

@section('title')
    Slide quảng cáo
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thuộc tính sản phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Thuộc tính</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card p-3">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Màu sắc</h5>
                        <a href="{{ route('admin.products.edit_color') }}" class="btn btn-success w-sm">Chỉnh sửa</a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">Xanh</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">Đỏ</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">Tím</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">Vàng</button>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card p-3">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Size</h5>
                        <a href="{{ route('admin.products.edit_size') }}" class="btn btn-success w-sm">Chỉnh sửa</a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">S</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">M</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">L</button>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-dark">Xl</button>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    @endsection
