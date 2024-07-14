@extends('admin.layout')

@section('title')
    Thuộc tính màu
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chỉnh sửa màu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thuộc tính</a></li>
                            <li class="breadcrumb-item active">Màu</li>
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
                        <div id="colors-container">
                            <div class="row mb-3 color-row">
                                <div class="col-lg-10">
                                    <div>
                                        <label for="color" class="form-label">Tên màu</label>
                                        <input type="number" class="form-control" id="color" name="color[]">
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-remove-color">Xóa</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button id="btn-add-color" type="button" class="btn btn-primary">Thêm màu +</button>
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
            document.getElementById('btn-add-color').addEventListener('click', function() {
                var colorContainer = document.getElementById('colors-container');
                var newColor = document.createElement('div');
                newColor.className = 'row mb-3 color-row';
                newColor.innerHTML = `
                    <div class="col-lg-10">
                        <div>
                            <label for="color" class="form-label">Tên màu</label>
                            <input type="number" class="form-control" id="color" name="color[]">
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-color">Xóa</button>
                    </div>
                `;
                colorContainer.appendChild(newColor);
                addRemoveButtonEvent(newColor.querySelector('.btn-remove-color'));
            });

            function addRemoveButtonEvent(button) {
                button.addEventListener('click', function() {
                    this.closest('.color-row').remove();
                });
            }

            document.querySelectorAll('.btn-remove-color').forEach(addRemoveButtonEvent);
        </script>
    @endsection
