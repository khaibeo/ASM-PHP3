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
                        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên slide</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="project-title-input" name="title" value="{{ old('title') }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="slides-container">
                                @for ($i = 0; $i < max(count(old('image_url', [1])), session('slide_count', 1)); $i++)
                                    <div class="row mb-3 slide-row">
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label for="choices-priority-input" class="form-label">Ảnh</label>
                                                <input class="form-control @error('image_url.'.$i) is-invalid @enderror" type="file" id="image_url" name="image_url[]">
                                                @error('image_url.'.$i)
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3 mb-lg-0">
                                                <label for="choices-status-input" class="form-label">Đường link</label>
                                                <input type="text" class="form-control @error('link_url.'.$i) is-invalid @enderror" id="link_url" name="link_url[]" value="{{ old('link_url.'.$i) }}" placeholder="Đường link sau khi click">
                                                @error('link_url.'.$i)
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <label for="datepicker-deadline-input" class="form-label">Số thứ tự</label>
                                                <input type="number" class="form-control @error('position.'.$i) is-invalid @enderror" id="position" name="position[]" value="{{ old('position.'.$i) }}" placeholder="Thứ tự slide">
                                                @error('position.'.$i)
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-remove-slide">Xóa</button>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div>
                                <button id="btn-add-slide" type="button" class="btn btn-primary">Thêm slide +</button>
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
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
@endsection

@section('scripts')
<script>
    var slideCount = {{ max(count(old('image_url', [1])), session('slide_count', 1)) }};

    document.getElementById('btn-add-slide').addEventListener('click', function() {
        if (slideCount >= 5) {
            alert('Chỉ được phép thêm tối đa 5 ảnh.');
            return;
        }

        var newSlide = createSlideElement(slideCount);
        document.getElementById('slides-container').appendChild(newSlide);
        addRemoveButtonEvent(newSlide.querySelector('.btn-remove-slide'));
        slideCount++;
    });

    function createSlideElement(index) {
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
        return newSlide;
    }

    function addRemoveButtonEvent(button) {
        button.addEventListener('click', function() {
            this.closest('.slide-row').remove();
            slideCount--;
        });
    }

    document.querySelectorAll('.btn-remove-slide').forEach(addRemoveButtonEvent);
</script>
@endsection