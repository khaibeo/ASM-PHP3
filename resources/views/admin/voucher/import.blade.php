@extends('admin.layout')

@section('title')
    Import mã giảm giá
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Import giảm giá</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mã giảm giá</a></li>
                            <li class="breadcrumb-item active">Import mã giảm giá</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="#" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="excelFile">Tải lên file exel</label>
                                <input type="file" name="file" class="form-control" id="excelFile"
                                    value="{{ old('file') }}" accept=".xls,.xlsx">
                            </div>
                            <div id="message"></div>
                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-danger w-sm">Quay lại</a>
                        <button type="button" id="upload-file" class="btn btn-success w-sm">Thêm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('administrator/assets/js/pages/project-create.init.js') }}"></script>

    <script>
        async function uploadFile() {
            const fileInput = document.getElementById('excelFile');
            const messageDiv = document.getElementById('message');

            const btn = document.getElementById('upload-file');
            var textOld = btn.textContent;

            if (!fileInput.files.length) {
                showMessage('Vui lòng chọn một file Excel', 'error');
                return;
            }

            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('file', file);

            try {
                btn.textContent = 'Đang nhập';
                const response = await fetch('/api/vouchers/import', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (response.ok) {
                    btn.textContent = textOld;

                    showMessage(`
                        Import thành công!<br>
                    `, 'success');
                } else {
                    btn.textContent = textOld;
                    if (result.errors && Array.isArray(result.errors)) {
                        showDetailedErrors(result.errors);
                    } else {
                        showMessage(`Lỗi: ${result.message || 'Đã xảy ra lỗi không xác định'}`, 'error');
                    }
                }
            } catch (error) {
                btn.textContent = textOld;
                showMessage(`Đã xảy ra lỗi: ${error.message}`, 'error');
            }
        }

        document.getElementById('upload-file').addEventListener('click',uploadFile);

        function showMessage(message, type) {
            const messageDiv = document.getElementById('message');
            messageDiv.innerHTML = message;
            messageDiv.className = type;
        }

        function showDetailedErrors(errors) {
            const messageDiv = document.getElementById('message');
            messageDiv.className = 'error';
            
            let errorHtml = '<h4>Các lỗi xảy ra trong quá trình import:</h4>';
            errorHtml += '<ul class="error-list">';
            
            errors.forEach(error => {
                errorHtml += `<li class="error-item">
                    <strong>Dòng ${error.row}:</strong>
                    <ul>
                        ${error.errors.map(err => `<li>${err}</li>`).join('')}
                    </ul>
                </li>`;
            });
            
            errorHtml += '</ul>';
            messageDiv.innerHTML = errorHtml;
        }
    </script>
@endsection

@section('stylesheets')
    <style>
        #message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .error-list {
            list-style-type: none;
            padding: 0;
        }
        .error-item {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #dc3545;
            border-radius: 3px;
        }
    </style>
@endsection
