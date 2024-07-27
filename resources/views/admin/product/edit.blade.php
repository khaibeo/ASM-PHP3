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
        @if ($errors->any())
            <div class="alert alert-danger">Đã có lỗi nhập liệu. Vui lòng kiểm tra lại !</div>
        @endif

        @session('error')
            <div class="alert alert-danger">{{session('error')}}</div>
        @endsession

        @session('success')
            <div class="alert alert-success">{{session('success')}}</div>
        @endsession

        <form id="edit-product-form" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin chung</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$product->name)}}">
                                @error('name')
                                    <span class="d-block text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sku">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{old('sku',$product->sku)}}">
                                @error('sku')
                                    <span class="d-block text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug',$product->slug)}}">
                                @error('slug')
                                    <span class="d-block text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="regular_price">Giá gốc</label>
                                <input type="number" class="form-control" id="regular_price" name="regular_price" value="{{old('regular_price',$product->regular_price)}}">
                                @error('regular_price')
                                    <span class="d-block text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sale_price">Giá sale</label>
                                <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{old('sale_price',$product->sale_price)}}">
                                @error('sale_price')
                                    <span class="d-block text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label>Mô tả sản phẩm</label>

                                <textarea id="ckeditor-classic" name="description">{{old('description',$product->description)}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div id="productForm">
                                    <div id="variants">
                                        @foreach($product->variants as $index => $variant)
                                            <div class="variant">
                                                <h4 class="fs-5">Biến thể {{ $index + 1 }}</h4>
                                                <div class="row mb-3">
                                                    <div class="form-group col-4">
                                                        <label>Giá thường:</label>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][regular_price]"
                                                            step="0.01" value="{{ $variant->regular_price }}" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Giá sale:</label>
                                                        <input type="number" class="form-control"
                                                            name="variants[{{ $index }}][sale_price]" step="0.01" value="{{ $variant->sale_price }}" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Số lượng:</label>
                                                        <input type="number" class="form-control" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" required>
                                                    </div>
                                                </div>

                                                <div class="attributes mb-3">
                                                    @foreach($variant->attributeValues as $attrIndex => $attribute)
                                                        <div class="row mb-3">
                                                            <label>Thuộc tính:</label>
                                                            <div class="form-group col-4">
                                                                <input type="text" class="form-control col-4"
                                                                    name="variants[{{ $index }}][attributes][{{ $attrIndex }}][name]"
                                                                    placeholder="Tên thuộc tính" value="{{ $attribute->attribute->name }}" required>
                                                            </div>

                                                            <div class="form-group col-4">
                                                                <input type="text" class="form-control col-4"
                                                                    name="variants[{{ $index }}][attributes][{{ $attrIndex }}][value]"
                                                                    placeholder="Giá trị thuộc tính" value="{{ $attribute->value }}" required>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-secondary add-attribute">Thêm thuộc tính</button>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="addVariant">Thêm biến thể</button>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success w-sm">Cập nhật sản phẩm</button>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh mục sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select" id="catalogue_id" name="catalogue_id">
                               

                                @foreach($catalogues as $category)
                                    <option value="{{ $category->id }}" {{ $product->catalogue_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
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
                                <label for="is_active" class="form-label">Trạng thái hoạt động</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active',$product->is_active) == 1 ? 'selected' : '' }}>Xuất bản</option>
                                    <option value="0" {{ old('is_active',$product->is_active) == 0 ? 'selected' : '' }}>Bản nháp</option>
                                </select>
                            </div>

                            <div>
                                <label for="is_featured" class="form-label">Đánh dấu nổi bật</label>
                                <select class="form-select" id="is_featured" name="is_featured">
                                    <option value="1" {{ old('is_active',$product->is_featured) == 1 ? 'selected' : '' }}>Có</option>
                                    <option value="0" {{ old('is_active',$product->is_featured) == 0 ? 'selected' : '' }}>Không</option>
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
                            <textarea class="form-control" rows="3" name="short_description">{{ $product->short_description }}</textarea>
                        </div>
                        <!-- end card body -->
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
                                                type="file" name="thumbnail" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded">
                                                <img src="{{ \Storage::url($product->thumbnail) }}" id="product-img" class="avatar-md h-auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="fs-14 mb-1">Bộ sưu tập ảnh</h5>
                                <p class="text-muted">Chọn nhiều ảnh.</p>

                                <div class="mb-3">
                                    <input name="product_galleries[]" class="form-control" type="file" multiple="multiple">
                                </div>

                                <div id="galleries" class="row">
                                    @foreach ($productImages as $image)
                                        <div class="col-4 mb-3">
                                            <img width="100%" height="100%" src="{{ \Storage::url($image->image) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- end dropzon-preview -->
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            @csrf
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

    <script>
        let variantCount = {{ count($product->variants) }};

        document.getElementById('addVariant').addEventListener('click', function() {
            const variantsContainer = document.getElementById('variants');
            const newVariant = document.createElement('div');
            newVariant.className = 'variant mt-4';
            newVariant.innerHTML = `
                <h4 class="fs-5">Biến thể ${++variantCount}</h4>
                <div class="row mb-3">
                    <div class="form-group col-4">
                        <label>Giá thường:</label>
                        <input type="number" class="form-control" name="variants[${variantCount-1}][regular_price]" step="0.01" required>
                    </div>
                    <div class="form-group col-4">
                        <label>Giá sale:</label>
                        <input type="number" class="form-control" name="variants[${variantCount-1}][sale_price]" step="0.01" required>
                    </div>
                    <div class="form-group col-4">
                        <label>Số lượng:</label>
                        <input type="number" class="form-control" name="variants[${variantCount-1}][stock]" required>
                    </div>
                </div>
                                            
                <div class="attributes mb-3">
                    <label>Thuộc tính:</label>
                    <div class="row mb-3">
                        <div class="form-group col-4">
                            <input type="text" class="form-control col-4" name="variants[${variantCount-1}][attributes][0][name]" placeholder="Tên thuộc tính" required>
                        </div>

                        <div class="form-group col-4">
                            <input type="text" class="form-control col-4" name="variants[${variantCount-1}][attributes][0][value]" placeholder="Giá trị thuộc tính" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-attribute">Thêm thuộc tính</button>
                <hr>
            `;
            variantsContainer.appendChild(newVariant);
            addAttributeListeners();
        });

        function addAttributeListeners() {
            document.querySelectorAll('.add-attribute').forEach(button => {
                button.addEventListener('click', function() {
                    const attributesContainer = this.previousElementSibling;
                    const attributeCount = attributesContainer.children.length;

                    const variantIndex = this.closest('.variant').querySelector('input[name$="[stock]"]')
                        .name.match(/\d+/)[0];
                    const newAttribute = document.createElement('div');
                    newAttribute.className = 'row mb-3';
                    newAttribute.innerHTML = `
                        <label>Thuộc tính:</label>
                        <div class="form-group col-4">
                            <input type="text" class="form-control col-4"
                                name="variants[${variantIndex}][attributes][${attributeCount}][name]"
                                placeholder="Tên thuộc tính" required>
                        </div>

                        <div class="form-group col-4">
                            <input type="text" class="form-control col-4"
                                name="variants[${variantIndex}][attributes][${attributeCount}][value]"
                                placeholder="Giá trị thuộc tính" required>
                        </div>
                    `;
                    attributesContainer.appendChild(newAttribute);
                });
            });
        }

        addAttributeListeners();

        // Xử lý xóa ảnh gallery
        // document.querySelectorAll('.remove-gallery').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const galleryId = this.getAttribute('data-id');
        //         if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
        //             // Gửi request AJAX để xóa ảnh
        //             fetch(`/admin/product-galleries/${galleryId}`, {
        //                 method: 'DELETE',
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        //                     'Accept': 'application/json',
        //                     'Content-Type': 'application/json'
        //                 },
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     this.closest('li').remove();
        //                 } else {
        //                     alert('Có lỗi xảy ra khi xóa ảnh');
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error:', error);
        //                 alert('Có lỗi xảy ra khi xóa ảnh');
        //             });
        //         }
        //     });
        // });
    </script>
@endsection
