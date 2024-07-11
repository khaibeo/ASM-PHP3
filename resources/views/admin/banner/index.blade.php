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
                    <h4 class="mb-sm-0">Slide trang chủ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Slide</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Tên slide</label>
                            <input type="text" class="form-control" id="project-title-input">
                        </div>

                        <div id="slides-container">
                            <div class="row mb-3 slide-row">
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-priority-input" class="form-label">Ảnh</label>
                                        <input class="form-control" type="file" id="image_url" name="image_url[]"> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-status-input" class="form-label">Đường link</label>
                                        <input type="text" class="form-control" id="link_url" name="link_url[]" placeholder="Đường link sau khi click">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div>
                                        <label for="datepicker-deadline-input" class="form-label">Số thứ tự</label>
                                        <input type="number" class="form-control" id="position" name="position[]" placeholder="Thứ tự slide">
                                    </div>
                                </div>
                                <div class="col-lg-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-remove-slide">Xóa</button>
                                </div>
                            </div>
                    </div>

                    <div>
                        <button id="btn-add-slide" type="button" class="btn btn-primary">Thêm slide +</button>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-danger w-sm">Quay lại</button>
                    <button type="submit" class="btn btn-success w-sm">Lưu</button>
                </div>
            </div>
            <!-- end col -->
            {{-- <div class="col-lg-4">
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
        </div> --}}
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
@endsection

@section('scripts')
<script>
    document.getElementById('btn-add-slide').addEventListener('click', function() {
        var slideContainer = document.getElementById('slides-container');
        var newSlide = document.createElement('div');
        newSlide.className = 'row mb-3 slide-row';
        newSlide.innerHTML = `
            <div class="col-lg-4">
                <div class="mb-3 mb-lg-0">
                    <label for="choices-priority-input" class="form-label">Ảnh</label>
                    <input class="form-control" type="file" id="image_url" name="image_url[]"> 
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3 mb-lg-0">
                    <label for="choices-status-input" class="form-label">Đường link</label>
                    <input type="text" class="form-control" id="link_url" name="link_url[]" placeholder="Đường link sau khi click">
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <label for="datepicker-deadline-input" class="form-label">Số thứ tự</label>
                    <input type="number" class="form-control" id="position" name="position[]" placeholder="Thứ tự slide">
                </div>
            </div>
            <div class="col-lg-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-remove-slide">Xóa</button>
            </div>
        `;
        slideContainer.appendChild(newSlide);
        addRemoveButtonEvent(newSlide.querySelector('.btn-remove-slide'));
    });

    function addRemoveButtonEvent(button) {
        button.addEventListener('click', function() {
            this.closest('.slide-row').remove();
        });
    }

    document.querySelectorAll('.btn-remove-slide').forEach(addRemoveButtonEvent);
</script>
@endsection
