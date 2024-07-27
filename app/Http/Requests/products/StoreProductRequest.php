<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
            'name' => "required",
            'sku' => "required|unique:products",
            'slug' => "required|unique:products",
            'regular_price' => 'required|regex:/^[1-9]\d*$/',
            'sale_price' => 'nullable|regex:/^[1-9]\d*$/',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'variants' => 'required|array|min:1',
            'variants.*.regular_price' => 'required|regex:/^[1-9]\d*$/',
            'variants.*.sale_price' => 'nullable|regex:/^[1-9]\d*$/',
            'variants.*.stock' => 'required|regex:/^[1-9]\d*$/',
            'variants.*.attributes' => 'required|array|min:1',
            'variants.*.attributes.*.name' => 'required',
            'variants.*.attributes.*.value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            "required" => ":attribute bắt buộc phải nhập",
            "unique" => "SKU đã tồn tại",
            "regex" => ":attribute phải là số nguyên dương",
            "mimes" => "Ảnh không đúng định dạng (jpeg,png,jpg,gif,svg)",
            "max" => "Kích thước ảnh quá lớn ( > 2MB )",
            "string" => ":attribute phải là chuỗi",
            'variants.required' => 'Ít nhất một biến thể sản phẩm là bắt buộc.',
            'variants.*.regular_price.required' => 'Giá thường của biến thể là bắt buộc.',
            'variants.*.regular_price.regex' => 'Giá thường của biến thể phải là số lớn hơn 0.',
            'variants.*.sale_price.regex' => 'Giá sale của biến thể phải là số lớn hơn 0.',
            'variants.*.stock.required' => 'Số lượng tồn kho của biến thể là bắt buộc.',
            'variants.*.stock.regex' => 'Số lượng tồn kho của biến thể phải lớn hơn 0.',
            'variants.*.attributes.required' => 'Mỗi biến thể phải có ít nhất một thuộc tính.',
            'variants.*.attributes.*.name.required' => 'Tên thuộc tính của biến thể là bắt buộc.',
            'variants.*.attributes.*.value.required' => 'Giá trị thuộc tính của biến thể là bắt buộc.',
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
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('variants', $this->input('variants'))
        );
    }
}
