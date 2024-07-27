@extends('admin.layout')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm sản phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm sản phẩm</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @if ($errors->any())
            <div class="alert alert-danger">Đã có lỗi nhập liệu. Vui lòng kiểm tra lại !</div>
        @endif

        <form id="createproduct-form" method="POST" action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin chunng</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sku">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku"
                                    value="{{ old('sku') }}">
                                @error('sku')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="regular_price">Giá gốc</label>
                                <input type="number" class="form-control" id="regular_price" name="regular_price"
                                    value="{{ old('regular_price') }}">
                                @error('regular_price')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sale_price">Giá sale</label>
                                <input type="number" class="form-control" id="sale_price" name="sale_price"
                                    value="{{ old('sale_price') }}">
                                @error('sale_price')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label>Mô tả sản phẩm</label>

                                <textarea id="ckeditor-classic" name="description">{{ old('description') }}
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
                                        @foreach (old('variants', []) as $index => $variant)
                                            <div class="variant mt-4">
                                                <h4 class="fs-5">Biến thể {{ $index + 1 }}</h4>
                                                <div class="row mb-3">
                                                    <div class="form-group col-4">
                                                        <label>Giá thường:</label>
                                                        <input type="number" class="form-control"
                                                            name="variants[{{ $index }}][regular_price]"
                                                            value="{{ $variant['regular_price'] ?? '' }}" step="0.01">
                                                        @error("variants.$index.regular_price")
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Giá sale:</label>
                                                        <input type="number" class="form-control"
                                                            name="variants[{{ $index }}][sale_price]"
                                                            value="{{ $variant['sale_price'] ?? '' }}" step="0.01">
                                                        @error("variants.$index.sale_price")
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Số lượng:</label>
                                                        <input type="number" class="form-control"
                                                            name="variants[{{ $index }}][stock]"
                                                            value="{{ $variant['stock'] ?? '' }}">
                                                        @error("variants.$index.stock")
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="attributes mb-3">
                                                    @foreach ($variant['attributes'] ?? [] as $attrIndex => $attribute)
                                                        <div class="row mb-3">
                                                            <label>Thuộc tính:</label>
                                                            <div class="form-group col-4">
                                                                <input type="text" class="form-control col-4"
                                                                    name="variants[{{ $index }}][attributes][{{ $attrIndex }}][name]"
                                                                    placeholder="Tên thuộc tính"
                                                                    value="{{ $attribute['name'] ?? '' }}">
                                                                @error("variants.$index.attributes.$attrIndex.name")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <input type="text" class="form-control col-4"
                                                                    name="variants[{{ $index }}][attributes][{{ $attrIndex }}][value]"
                                                                    placeholder="Giá trị thuộc tính"
                                                                    value="{{ $attribute['value'] ?? '' }}">
                                                                @error("variants.$index.attributes.$attrIndex.value")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-secondary add-attribute">Thêm thuộc
                                                    tính</button>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-3" id="addVariant">Thêm biến
                                        thể</button>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success w-sm">Lưu sản phẩm</button>
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
                                @forEach($catalogues as $ct)
                                <option value="{{$ct->id}}" {{ old('catalogue_id') == $ct->id ? 'selected' : '' }}>{{$ct->name}}</option>
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
                                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Bản nháp</option>
                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Xuất bản
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="is_featured" class="form-label">Đánh dấu nổi bật</label>
                                <select class="form-select" id="is_featured" name="is_featured">
                                    <option value="0" {{ old('is_featured', 0) == 0 ? 'selected' : '' }}>Không
                                    </option>
                                    <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Có</option>
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
                            <textarea class="form-control" rows="3" name="short_description">{{ old('short_description') }}</textarea>
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
                                <p class="text-muted mb-1">Thêm ảnh đại diện</p>
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                            <input class="form-control d-none" value="{{ old('name') }}"
                                                id="product-image-input" type="file" name="thumbnail"
                                                accept="image/png, image/gif, image/jpeg, imgae/jpg">
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

                                <div>
                                    <input name="product_galleries[]" class="form-control" type="file"
                                        multiple="multiple" accept="image/png, image/gif, image/jpeg, imgae/jpg">
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            let variantCount = {{ count(old('variants', [])) }};

            document.getElementById('addVariant').addEventListener('click', function() {
                const variantsContainer = document.getElementById('variants');
                const newVariant = document.createElement('div');
                newVariant.className = 'variant mt-4';
                newVariant.innerHTML = `
            <h4 class="fs-5">Biến thể ${++variantCount}</h4>
            <div class="row mb-3">
                <div class="form-group col-4">
                    <label>Giá thường:</label>
                    <input type="number" class="form-control" name="variants[${variantCount-1}][regular_price]" step="0.01" >
                </div>
                <div class="form-group col-4">
                    <label>Giá sale:</label>
                    <input type="number" class="form-control" name="variants[${variantCount-1}][sale_price]" step="0.01">
                </div>
                <div class="form-group col-4">
                    <label>Số lượng:</label>
                    <input type="number" class="form-control" name="variants[${variantCount-1}][stock]" >
                </div>
            </div>
            
            <div class="attributes mb-3">
                <div class="row mb-3">
                    <label>Thuộc tính:</label>
                    <div class="form-group col-4">
                        <input type="text" class="form-control col-4" name="variants[${variantCount-1}][attributes][0][name]" placeholder="Tên thuộc tính" >
                    </div>
                    <div class="form-group col-4">
                        <input type="text" class="form-control col-4" name="variants[${variantCount-1}][attributes][0][value]" placeholder="Giá trị thuộc tính" >
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
                        const variantDiv = this.closest('.variant');
                        const attributesContainer = variantDiv.querySelector('.attributes');
                        const attributeInputs = variantDiv.querySelectorAll(
                            '.attributes input[name$="[name]"]');
                        const attributeCount = attributeInputs.length;

                        const variantIndex = variantDiv.querySelector('input[name$="[stock]"]')
                            .name.match(/variants\[(\d+)\]/)[1];

                        const newAttribute = document.createElement('div');
                        newAttribute.className = 'row mb-3';
                        newAttribute.innerHTML = `
                    <label>Thuộc tính:</label>
                    <div class="form-group col-4">
                        <input type="text" class="form-control col-4"
                            name="variants[${variantIndex}][attributes][${attributeCount}][name]"
                            placeholder="Tên thuộc tính" >
                    </div>
                    <div class="form-group col-4">
                        <input type="text" class="form-control col-4"
                            name="variants[${variantIndex}][attributes][${attributeCount}][value]"
                            placeholder="Giá trị thuộc tính" >
                    </div>
                `;
                        attributesContainer.appendChild(newAttribute);
                    });
                });
            }

            addAttributeListeners();
        });
    </script>
@endsection
