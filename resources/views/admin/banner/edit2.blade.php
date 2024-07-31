@extends('admin.layout')

@section('title')
    Chỉnh sửa Slide
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chỉnh sửa Slide</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Slide</a></li>
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
                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên slide</label>
                                <input type="text" class="form-control" id="project-title-input" name="title" required value="{{ old('title', $banner->title) }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="slides-container">
                                <div class="row mb-3 slide-row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="choices-priority-input" class="form-label">Ảnh hiện tại</label>
                                            <div>
                                                @if ($banner->image_url)
                                                    <img src="{{ asset($banner->image_url) }}" alt="Current Image" style="max-width: 100%; height: auto;">
                                                @else
                                                    <p>Không có ảnh hiện tại</p>
                                                @endif
                                            </div>
                                            <label for="image_url" class="form-label">Chọn ảnh mới</label>
                                            <input class="form-control" type="file" id="image_url" name="image_url">
                                            @error('image_url')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="choices-status-input" class="form-label">Đường link</label>
                                            <input type="text" class="form-control" id="link_url" name="link_url" placeholder="Đường link sau khi click" value="{{ old('link_url', $banner->link_url) }}">
                                            @error('link_url')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div>
                                            <label for="datepicker-deadline-input" class="form-label">Số thứ tự</label>
                                            <input type="number" class="form-control" id="position" name="position" placeholder="Thứ tự slide" required value="{{ old('position', $banner->position) }}">
                                            @error('position')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-remove-slide">Xóa</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hoạt động</label>
                                <input type="checkbox" name="active" value="1" {{ old('active', $banner->active) ? 'checked' : '' }}>
                                <small class="form-text text-muted">Chỉ cho phép một slide hoạt động tại một thời điểm.</small>
                                @error('active')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end mb-4">
                                <button type="submit" class="btn btn-success w-sm">Lưu</button>
                                <button type="button" class="btn btn-danger w-sm" onclick="window.history.back()">Quay lại</button>
                            </div>
                        </form>
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
<script>
    document.getElementById('btn-add-slide').addEventListener('click', function() {
        var slideContainer = document.getElementById('slides-container');
        if (slideContainer.childElementCount >= 3) {
            alert('Chỉ được phép thêm tối đa 3 ảnh.');
            return;
        }
        var newSlide = document.createElement('div');
        newSlide.className = 'row mb-3 slide-row';
        newSlide.innerHTML = `
            <div class="col-lg-4">
                <div class="mb-3 mb-lg-0">
                    <label for="choices-priority-input" class="form-label">Ảnh</label>
                    <input class="form-control" type="file" id="image_url" name="image_url[]" required> 
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
                    <input type="number" class="form-control" id="position" name="position[]" placeholder="Thứ tự slide" required>
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
