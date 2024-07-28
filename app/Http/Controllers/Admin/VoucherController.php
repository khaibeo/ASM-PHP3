<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VouchersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function list()
    {
        $data['voucher']= VouchersModel::getAll();
        return view('admin.voucher.index',$data);
    }

    public function add()
    {

        return view('admin.voucher.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'discount_type' => 'required|in:0,1',
            'discount_value' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
        ],
        [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được dài quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'description.max' => 'Mô tả không được dài quá 500 ký tự',
            'code.required' => 'Mã code không được để trống',
            'code.max' => 'Mã code không được dài quá 100 ký tự',
            'code.unique' => 'Mã code đã tồn tại',
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
        ]);

        $request->validate([
            'discount_value' => [
                function($attribute, $value, $fail) use ($request) {
                    if ($request->discount_type == 1 && $value > 100) {
                        $fail('Giá trị giảm tối đa không được vượt quá 100 khi loại giảm giá là phần trăm.');
                    }
                }
            ]
        ]);
    
        $voucher = new VouchersModel;
        $voucher->name = trim($request->name);
        $voucher->code = trim($request->code);
        $voucher->description = trim($request->description);
        $voucher->discount_type = trim($request->discount_type);
        $voucher->discount_value = trim($request->discount_value);
        $voucher->quantity = trim($request->quantity);
        $voucher->valid_from = trim($request->valid_from);
        $voucher->valid_until = trim($request->valid_until);
        $voucher->save();
        
        return redirect('admin/vouchers/index');
    }

    public function edit($id)
    {
        $data['voucher'] = VouchersModel::getSingle($id);
        return view('admin.voucher.edit', $data);
        
    }

        public function update($id, Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:100',
                'description' => 'required|string|max:500',
                'discount_type' => 'required|in:0,1',
                'discount_value' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'valid_from' => 'required|date',
                'valid_until' => 'required|date|after_or_equal:valid_from',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.max' => 'Tên không được dài quá 255 ký tự',
                'description.required' => 'Mô tả không được để trống',
                'description.max' => 'Mô tả không được dài quá 500 ký tự',
                'code.required' => 'Mã code không được để trống',
                'code.max' => 'Mã code không được dài quá 100 ký tự',
                'code.unique' => 'Mã code đã tồn tại',
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
            ]);
            
            $request->validate([
                'discount_value' => [
                    function($attribute, $value, $fail) use ($request) {
                        if ($request->discount_type == 1 && $value > 100) {
                            $fail('Giá trị giảm tối đa không được vượt quá 100 khi loại giảm giá là phần trăm.');
                        }
                    }
                ]
            ]);

            $voucher = VouchersModel::getSingle($id);
            $voucher->name = trim($request->name);
            $voucher->code = trim($request->code);
            $voucher->description = trim($request->description);
            $voucher->discount_type = trim($request->discount_type);
            $voucher->discount_value = trim($request->discount_value);
            $voucher->quantity = trim($request->quantity);
            $voucher->valid_from = trim($request->valid_from);
            $voucher->valid_until = trim($request->valid_until);
            $voucher->save();
            
            
            return redirect('admin/vouchers/index');
        }

    public function delete($id)
{
    $voucher = VouchersModel::getSingle($id);
    $voucher->delete();
    return redirect()->route('admin.vouchers.index');
}

}
