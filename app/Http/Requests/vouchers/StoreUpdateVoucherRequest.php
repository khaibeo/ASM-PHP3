<?php

namespace App\Http\Requests\vouchers;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'discount_type' => 'required|in:0,1',
            'discount_value' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_order_value' => 'nullable|nullable|numeric|gte:min_order_value',
            'max_discount_value' => 'nullable|nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được dài quá 255 ký tự',
            
            'description.max' => 'Mô tả không được dài quá 500 ký tự',
            'code.required' => 'Mã code không được để trống',
            'code.max' => 'Mã code không được dài quá 100 ký tự',
            'discount_type.required' => 'Loại giảm giá không được để trống',
            'discount_type.integer' => 'Loại giảm giá phải là số nguyên',
            'discount_type.in' => 'Loại giảm giá không hợp lệ',
            'discount_value.required' => 'Giá trị giảm không được để trống',
            'discount_value.numeric' => 'Giá trị giảm phải là số',
            'discount_value.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0',
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1',
            'valid_from.required' => 'Thời gian bắt đầu không được để trống',
            'valid_from.date' => 'Thời gian bắt đầu phải là ngày hợp lệ',
            'valid_until.required' => 'Thời gian kết thúc không được để trống',
            'valid_until.date' => 'Thời gian kết thúc phải là ngày hợp lệ',
            'valid_until.after_or_equal' => 'Thời gian kết thúc phải sau hoặc bằng thời gian bắt đầu',
            'min_order_value.required' => 'Giá trị đơn hàng tối thiểu không được để trống',
            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là số',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0',
            'max_order_value.required' => 'Giá trị đơn hàng tối đa không được để trống',
            'max_order_value.numeric' => 'Giá trị đơn hàng tối đa phải là số',
            'max_order_value.gte' => 'Giá trị đơn hàng tối đa phải lớn hơn hoặc bằng giá trị đơn hàng tối thiểu',
            'max_discount_value.required' => 'Giá trị giảm giá tối đa không được để trống',
            'max_discount_value.numeric' => 'Giá trị giảm giá tối đa phải là số',
            'max_discount_value.min' => 'Giá trị giảm giá tối đa phải lớn hơn hoặc bằng 0',
        ];
    }
}
