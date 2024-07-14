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

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Tên mã giảm giá</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Mô tả</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Mã code</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <label for="choices-priority-input" class="form-label">Loại giảm giá</label>
                                <select class="form-select">
                                    <option value="0" selected>Theo phần trăm</option>
                                    <option value="1">Giảm giá trực tiếp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <label for="choices-status-input" class="form-label">Giá trị giảm</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="datepicker-deadline-input" class="form-label">Số lượng</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="text-end mb-4">
                <button type="submit" class="btn btn-danger w-sm">Quay lại</button>
                <button type="submit" class="btn btn-success w-sm">Sửa</button>
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
                        <label for="choices-categories-input" class="form-label">Thời gian bắt đầu</label>
                        <input class="form-control" id="choices-text-input" type="date" />
                    </div>

                    <div>
                        <label for="choices-text-input" class="form-label">Thời gian kết thúc</label>
                        <input class="form-control" id="choices-text-input" type="date" />
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

</div>
<!-- container-fluid -->
@endsection

@section('scripts')
    <!-- project-create init -->
    <script src="{{ asset('administrator/assets/js/pages/project-create.init.js') }}"></script>
@endsection