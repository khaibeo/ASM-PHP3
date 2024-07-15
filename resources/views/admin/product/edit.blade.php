@extends('admin.layout')

@section('title')
    Sửa sản phẩm
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sửa sản phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Sửa sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form id="editproduct-form" autocomplete="off" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product-title-input" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">SKU</label>
                                <input type="text" class="form-control" id="product-title-input" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Slug</label>
                                <input type="text" class="form-control" id="product-title-input" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Giá gốc</label>
                                <input type="text" class="form-control" id="product-title-input" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Giá sale</label>
                                <input type="text" class="form-control" id="product-title-input" value="">
                            </div>
                            <div>
                                <label>Mô tả sản phẩm</label>

                                <div id="ckeditor-classic">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ảnh sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-14 mb-1">Ảnh đại diện</h5>
                                <p class="text-muted">Thêm ảnh đại diện</p>
                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute top-100 start-100 translate-middle">
                                            <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Select Image">
                                                <div class="avatar-xs">
                                                    <div
                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="product-image-input"
                                                type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded">
                                                <img src="" id="product-img" class="avatar-md h-auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="fs-14 mb-1">Bộ sưu tập ảnh</h5>
                                <p class="text-muted">Chọn nhiều ảnh.</p>

                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                        </div>

                                        <h5>Thả ảnh vào đây hoặc click để tải lên</h5>
                                    </div>
                                </div>

                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                    <li class="mt-2" id="dropzone-preview-list">
                                        <!-- This is used as the file preview template -->
                                        <div class="border rounded">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm bg-light rounded">
                                                        <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                            src="#" alt="Product-Image" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="pt-1">
                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                        <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-3">
                                                    <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- end dropzon-preview -->
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success w-sm">Thêm</button>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh mục sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select" id="choices-category-input" name="choices-category-input"
                                data-choices data-choices-search-false>
                                <option value="Appliances">Appliances</option>
                                <option value="Automotive Accessories">Automotive Accessories</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Grocery">Grocery</option>
                                <option value="Kids">Kids</option>
                                <option value="Watches">Watches</option>
                            </select>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trạng thái</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="choices-publish-status-input" class="form-label">Trạng thái hoạt động</label>

                                <select class="form-select" id="choices-publish-status-input" data-choices
                                    data-choices-search-false>
                                    <option value="Published" selected>Xuất bản</option>
                                    <option value="Draft">Bản nháp</option>
                                </select>
                            </div>

                            <div>
                                <label for="choices-publish-visibility-input" class="form-label">Đánh dấu nổi bật</label>
                                <select class="form-select" id="choices-publish-visibility-input" data-choices
                                    data-choices-search-false>
                                    <option value="Public" >Có</option>
                                    <option value="Hidden" selected>Không</option>
                                </select>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mô tả ngắn</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">Viết một vài câu mô tả ngắn cho sản phẩm</p>
                            <textarea class="form-control"  rows="3"></textarea>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </form>

    </div>
    <!-- container-fluid -->
@endsection

@section('stylesheets')
    <!-- Plugins css -->
    <link href="{{ asset('administrator/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <!-- ckeditor -->
    <script src="{{ asset('administrator/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ asset('administrator/assets/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('administrator/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
@endsection
