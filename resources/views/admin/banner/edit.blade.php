@extends('admin.layout')

@section('title')
    Sửa Slide Quảng Cáo
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sửa Slide</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Slide</a></li>
                            <li class="breadcrumb-item active">Sửa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="card-body">
                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="title">Tên slide</label>
                                <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $banner->title) }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="slides-container">
                                @foreach($banner->details as $detail)
                                    <div class="row mb-3 slide-row" data-id="{{ $detail->id }}">
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label class="form-label">Ảnh</label>
                                                <img src="{{ asset('storage/' . $detail->image_url) }}" alt="Slide Image" style="max-width: 100px; height: auto;">
                                                <input type="file" name="image_url[{{ $detail->id }}]">
                                                <input type="hidden" name="old_image_url[{{ $detail->id }}]" value="{{ $detail->image_url }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label class="form-label">Đường link</label>
                                                <input type="text" class="form-control" name="link_url[{{ $detail->id }}]" value="{{ old('link_url.' . $detail->id, $detail->link_url) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <label class="form-label">Số thứ tự</label>
                                                <input type="number" class="form-control" name="position[{{ $detail->id }}]" value="{{ old('position.' . $detail->id, $detail->position) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-remove-slide" data-id="{{ $detail->id }}">Xóa</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div>
                                <button id="btn-add-slide" type="button" class="btn btn-primary mt-3">Thêm ảnh +</button>
                                @if ($banner->details->count() >= 5)
                                    <div class="alert alert-warning mt-3">Bạn đã đạt giới hạn số ảnh (5 ảnh) cho slide này.</div>
                                @endif
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
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.getElementById('btn-add-slide').addEventListener('click', function() {
        var slideContainer = document.getElementById('slides-container');
        if (slideContainer.childElementCount >= 5) {
            alert('Chỉ được phép thêm tối đa 5 ảnh.');
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