@extends('admin.layout')

@section('title')
    Thêm danh mục
@endsection

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh mục</a></li>
                        <li class="breadcrumb-item active">Thêm danh mục</li>
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
                        <label class="form-label" for="project-title-input">Tên danh mục</label>
                        <input type="text" class="form-control" id="project-title-input" placeholder="Nhập tên danh mục">
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3 mb-lg-0">
                                <label for="choices-priority-input" class="form-label">Danh mục cha</label>
                                <select class="form-select" data-choices data-choices-search-false id="choices-priority-input">
                                    <option value="High" selected>Không</option>
                                    <option value="Medium">Danh mục 1</option>
                                    <option value="Low">Danh mục 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 mb-lg-0">
                                <label for="choices-status-input" class="form-label">Trạng thái</label>
                                <select class="form-select" data-choices data-choices-search-false id="choices-status-input">
                                    <option value="Inprogress" selected>Hoạt động</option>
                                    <option value="Completed">Bản nháp</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-thumbnail-img">Ảnh đại diện</label>
                        <input class="form-control" id="project-thumbnail-img" type="file" accept="image/png, image/gif, image/jpeg">
                    </div>

                    <div class="text-end mb-4 mt-4">
                        <button type="submit" class="btn btn-danger w-sm">Quay lại</button>
                        
                        <button type="submit" class="btn btn-success w-sm">Thêm</button>
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
