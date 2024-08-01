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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="title">Tên slide</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title', $banner->title) }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="slides-container">
                                @foreach($banner->details as $index => $detail)
                                    <div class="row mb-3 slide-row" data-id="{{ $detail->id }}">
                                        <input type="hidden" name="existing_slide_ids[]" value="{{ $detail->id }}">
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label class="form-label">Ảnh</label>
                                                <img src="{{ asset('storage/' . $detail->image_url) }}" alt="Slide Image" style="max-width: 100px; height: auto;">
                                                <input type="file" name="image_url[{{ $detail->id }}]" class="form-control @error('image_url.' . $detail->id) is-invalid @enderror">
                                                @error('image_url.' . $detail->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label class="form-label">Đường link</label>
                                                <input type="text" class="form-control @error('link_url.' . $detail->id) is-invalid @enderror" name="link_url[{{ $detail->id }}]" value="{{ old('link_url.' . $detail->id, $detail->link_url) }}">
                                                @error('link_url.' . $detail->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <label class="form-label">Số thứ tự</label>
                                                <input type="number" class="form-control @error('position.' . $detail->id) is-invalid @enderror" name="position[{{ $detail->id }}]" value="{{ old('position.' . $detail->id, $detail->position) }}">
                                                @error('position.' . $detail->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-remove-slide" data-id="{{ $detail->id }}">Xóa</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div id="deleted-slides"></div>

                            <div>
                                <button id="btn-add-slide" type="button" class="btn btn-primary mt-3">Thêm ảnh +</button>
                                @if ($banner->details->count() >= 5)
                                    <div class="alert alert-warning mt-3">Bạn đã đạt giới hạn số ảnh (5 ảnh) cho slide này.</div>
                                @endif
                            </div>

                            <div class="text-end mb-4">
                                <button type="submit" class="btn btn-success w-sm">Lưu</button>
                                <a href="{{route('admin.banners.index')}}"><button type="button" class="btn btn-danger w-sm">Quay lại</button></a>
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
    // Truyền dữ liệu từ Blade vào JavaScript
    let slideCount = @json($banner->details->count());
    let newSlideCount = @json(old('new_slides') ? count(old('new_slides')) : 0);

    document.getElementById('btn-add-slide').addEventListener('click', function() {
        if (slideCount >= 5) {
            alert('Chỉ được phép thêm tối đa 5 ảnh.');
            return;
        }
        addNewSlide();
    });

    function addNewSlide() {
        const slideContainer = document.getElementById('slides-container');
        const newSlide = document.createElement('div');
        newSlide.className = 'row mb-3 slide-row';
        newSlide.innerHTML = `
            <input type="hidden" name="new_slides[]" value="${newSlideCount}">
            <div class="col-lg-4">
                <div class="mb-3 mb-lg-0">
                    <label class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="image_url[new_${newSlideCount}]" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3 mb-lg-0">
                    <label class="form-label">Đường link</label>
                    <input type="text" class="form-control" name="link_url[new_${newSlideCount}]" value="" placeholder="Đường link sau khi click">
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <label class="form-label">Số thứ tự</label>
                    <input type="number" class="form-control" name="position[new_${newSlideCount}]" value="" placeholder="Thứ tự slide" required>
                </div>
            </div>
            <div class="col-lg-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-remove-new-slide">Xóa</button>
            </div>
        `;
        slideContainer.appendChild(newSlide);
        addRemoveButtonEvent(newSlide.querySelector('.btn-remove-new-slide'));
        slideCount++;
        newSlideCount++;
    }

    function addRemoveButtonEvent(button) {
        button.addEventListener('click', function() {
            this.closest('.slide-row').remove();
            slideCount--;
        });
    }

    document.querySelectorAll('.btn-remove-slide').forEach(function(button) {
        button.addEventListener('click', function() {
            const slideId = this.getAttribute('data-id');
            const deletedSlides = document.getElementById('deleted-slides');
            deletedSlides.innerHTML += `<input type="hidden" name="deleted_slides[]" value="${slideId}">`;
            this.closest('.slide-row').style.display = 'none';
            slideCount--;
        });
    });

    // Khôi phục các slide mới nếu có lỗi validation
    @if(old('new_slides'))
        @foreach(old('new_slides') as $index => $newSlide)
            addNewSlide();
        @endforeach
    @endif
</script>
@endsection
