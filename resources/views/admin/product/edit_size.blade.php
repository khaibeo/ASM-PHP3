@extends('admin.layout')

@section('title')
    Thuộc tính size
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chỉnh sửa size</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thuộc tính</a></li>
                            <li class="breadcrumb-item active">Size</li>
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
                        <div id="sizes-container">
                            <div class="row mb-3 size-row">
                                <div class="col-lg-10">
                                    <div>
                                        <label for="size" class="form-label">Tên size</label>
                                        <input type="number" class="form-control" id="size" name="size[]">
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-remove-size">Xóa</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button id="btn-add-size" type="button" class="btn btn-primary">Thêm size +</button>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="text-end mb-4">
                        <a href="{{ route('admin.products.variant') }}" class="btn btn-danger w-sm">Quay lại</a>
                        <button type="submit" class="btn btn-success w-sm">Lưu</button>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    @endsection

    @section('scripts')
        <script>
            document.getElementById('btn-add-size').addEventListener('click', function() {
                var sizeContainer = document.getElementById('sizes-container');
                var newSize = document.createElement('div');
                newSize.className = 'row mb-3 size-row';
                newSize.innerHTML = `
                    <div class="col-lg-10">
                        <div>
                            <label for="size" class="form-label">Tên size</label>
                            <input type="number" class="form-control" id="size" name="size[]">
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-size">Xóa</button>
                    </div>
                `;
                sizeContainer.appendChild(newSize);
                addRemoveButtonEvent(newSize.querySelector('.btn-remove-size'));
            });

            function addRemoveButtonEvent(button) {
                button.addEventListener('click', function() {
                    this.closest('.size-row').remove();
                });
            }

            document.querySelectorAll('.btn-remove-size').forEach(addRemoveButtonEvent);
        </script>
    @endsection
