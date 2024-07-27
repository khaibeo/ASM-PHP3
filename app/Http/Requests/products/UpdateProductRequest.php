<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $id = request()->route('id');

        return [
            'name' => "required",
            'sku' => "required|unique:products,sku," . $id,
            'slug' => "required|unique:products,slug," . $id,
            'regular_price' => 'required|regex:/^[1-9]\d*$/',
        ];;
    }

    public function messages()
    {
        return [
            "required" => ":attribute bắt buộc phải nhập",
            "unique" => ":attribute đã tồn tại",
            "regex" => ":attribute phải là số nguyên dương",
            "mimes" => "Ảnh không đúng định dạng (jpeg,png,jpg,gif,svg)",
            "max" => "Kích thước ảnh quá lớn ( > 2MB )",
            "string" => ":attribute phải là chuỗi"
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Tên sản phẩm",
            'sku' => "Mã SKU",
            'slug' => "Slug",
            'regular_price' => 'Giá gốc',
            'sale_price' => 'Giá sale',
            'thumbnail' => 'Ảnh đại diện',
            'variants.*.regular_price' => 'Giá gốc',
            'variants.*.stock' => 'Số lượng',
            'variants.*.attributes.*.name' => 'Tên thuộc tính',
            'variants.*.attributes.*.value' => 'Giá trị thuộc tính',
        ];
    }
}
