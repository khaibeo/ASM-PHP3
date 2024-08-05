<?php

namespace App\Imports;

use App\Models\Voucher;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class VoucherImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new Voucher([
            'code' => $row['code'],
            'name' => $row['name'],
            'description' => $row['description'],
            'discount_type' => $row['discount_type'],
            'discount_value' => $row['discount_value'],
            'max_discount_value	' => $row['max_discount_value'],
            'quantity' => $row['quantity'],
            'valid_from' => $row['valid_from'],
            'valid_until' => $row['valid_until'],
            'min_order_value' => $row['min_order_value'] ?? 0,
            'max_order_value' => $row['max_order_value'],
            'display_status' => $row['display_status'],
        ]);
    }

    public function prepareForValidation(array $row)
    {
        $row['valid_from'] = $this->excelDateToPhpDate($row['valid_from']);
        $row['valid_until'] = $this->excelDateToPhpDate($row['valid_until']);
        return $row;
    }

    public function rules(): array
    {
        return [
            '*.code' => 'required|unique:vouchers,code',
            '*.name' => 'nullable',
            '*.description' => 'nullable',
            '*.discount_type' => 'required|in:0,1',
            '*.discount_value' => 'required|min:0',
            '*.max_discount_value' => 'nullable|integer|min:1',
            '*.quantity' => 'required|integer|min:1',
            '*.valid_from' => 'required|date',
            '*.valid_until' => 'required|date|after:*.valid_from',
            '*.min_order_value' => 'nullable|integer|min:0',
            '*.max_order_value' => 'nullable|integer|min:1000',
            '*.display_status' => 'nullable|in:0,1',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.code.required' => ':attribute bắt buộc phải nhập',
            '*.discount_type.required' => ':attribute bắt buộc phải nhập',
            '*.name.required' => ':attribute bắt buộc phải nhập',
            '*.discount_value.required' => ':attribute bắt buộc phải nhập',
            '*.quantity.required' => ':attribute bắt buộc phải nhập',
            '*.valid_from.required' => ':attribute bắt buộc phải nhập',
            '*.valid_until.required' => ':attribute bắt buộc phải nhập',

            '*.discount_type.in' => ':attribute không hợp lệ ( 0 ,1 )',
            '*.display_status.in' => ':attribute không hợp lệ ( 0 ,1 )',

            '*.discount_value.min' => ':attribute tối thiểu là :min',
            '*.max_discount_value.min' => ':attribute tối thiểu là :min',
            '*.max_discount_value.integer' => ':attribute phải là số nguyên',
            '*.quantity.min' => ':attribute tối thiểu là :min',
            '*.quantity.integer' => ':attribute phải là số nguyên',

            '*.min_order_value.min' => ':attribute tối thiểu là :min',
            '*.min_order_value.integer' => ':attribute phải là số nguyên',

            '*.max_order_value.min' => ':attribute tối thiểu là :min',
            '*.max_order_value.integer' => ':attribute phải là số nguyên',

            '*.code.unique' => ':attribute đã tồn tại',
            
            
            '*.valid_from.date' => ':attribute không đúng định dạng',
            '*.valid_until.date' => ':attribute không đúng định dạng',
            '*.valid_until.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '*.code' => 'Mã code',
            '*.name' => 'Tên mã giảm giá',
            '*.description' => 'Mô tả',
            '*.discount_type' => 'Loại giảm giá',
            '*.discount_value' => 'Giá trị giảm',
            '*.max_discount_value' => 'Giá trị giảm tối đa',
            '*.quantity' => 'Số lượng',
            '*.valid_from' => 'Thời gian bắt đầu',
            '*.valid_until' => 'Thời gian kết thúc',
            '*.min_order_value' => 'Giá trị đơn hàng tối thiểu',
            '*.max_order_value' => 'Giá trị đơn hàng tối đa',
            '*.display_status' => 'Trạng thái hiển thị',
        ];
    }

    private function excelDateToPhpDate($excelDate)
    {
        if (!is_numeric($excelDate)) {
            return $excelDate;
        }

        // Excel sử dụng hệ thống ngày bắt đầu từ 1/1/1900
        $unixTimestamp = ($excelDate - 25569) * 86400;
        return Carbon::createFromTimestamp($unixTimestamp)->timezone('UTC')->format('Y-m-d H:i:s');
    }
}
