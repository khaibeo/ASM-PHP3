<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\vouchers\StoreUpdateVoucherRequest;
use App\Http\Requests\vouchers\StoreVoucherRequest;
use App\Imports\VoucherImport;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function list(Request $request)
    {
        $query = Voucher::query();

        if ($request->has('discount_type') && $request->discount_type !== null) {
            $query->where('discount_type', $request->discount_type);
        }

        if ($request->has('expiry_status') && $request->expiry_status !== null) {
            $today = now()->format('Y-m-d');
            if ($request->expiry_status === 'active') {
                $query->where('valid_until', '>=', $today);
            } elseif ($request->expiry_status === 'expired') {
                $query->where('valid_until', '<', $today);
            }
        }

        if ($request->has('display_status') && $request->display_status !== null) {
            $query->where('display_status', $request->display_status);
        }

        $data['vouchers'] = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('admin.voucher.index', $data);
    }

    public function add()
    {
        return view('admin.voucher.add');
    }

    public function insert(StoreVoucherRequest $request)
    {
        $request->validate([
            'discount_value' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->discount_type == 1 && $value > 100) {
                        $fail('Giá trị giảm tối đa không được vượt quá 100 khi loại giảm giá là phần trăm.');
                    }
                }
            ]
        ]);

        $voucher = new Voucher;
        $voucher->name = trim($request->name);
        $voucher->code = trim($request->code);
        $voucher->description = trim($request->description);
        $voucher->discount_type = trim($request->discount_type);
        $voucher->discount_value = trim($request->discount_value);
        $voucher->quantity = trim($request->quantity);
        $voucher->valid_from = trim($request->valid_from);
        $voucher->valid_until = trim($request->valid_until);
        $voucher->min_order_value = $request->min_order_value ?? 0;
        $voucher->max_order_value = $request->max_order_value ?? null;
        $voucher->max_discount_value = $request->max_discount_value ?? null;
        $voucher->display_status = $request->has('display_status') ? 1 : 0;
        $voucher->save();

        return redirect('admin/vouchers/index');
    }

    public function edit($id)
    {
        $data['voucher'] = Voucher::getSingle($id);
        return view('admin.voucher.edit', $data);
    }

    public function update($id, StoreUpdateVoucherRequest $request)
    {

        $request->validate([
            'discount_value' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->discount_type == 1 && $value > 100) {
                        $fail('Giá trị giảm tối đa không được vượt quá 100 khi loại giảm giá là phần trăm.');
                    }
                }
            ]
        ]);

        $voucher = Voucher::getSingle($id);
        $voucher->name = trim($request->name);
        $voucher->code = trim($request->code);
        $voucher->description = trim($request->description);
        $voucher->discount_type = trim($request->discount_type);
        $voucher->discount_value = trim($request->discount_value);
        $voucher->quantity = trim($request->quantity);
        $voucher->valid_from = trim($request->valid_from);
        $voucher->valid_until = trim($request->valid_until);
        $voucher->min_order_value = trim($request->min_order_value ?? 0);
        $voucher->max_order_value = $request->max_order_value ?? null;
        $voucher->max_discount_value = $request->max_discount_value;
        $voucher->display_status = $request->has('display_status') ? 1 : 0;
        $voucher->save();

        return redirect('admin/vouchers/index');
    }


    public function delete($id)
    {
        $voucher = Voucher::getSingle($id);
        $voucher->delete();
        return redirect()->route('admin.vouchers.index');
    }

    public function showImport()
    {
        return view('admin.voucher.import');
    }

    //Nhập từ file exel
    public function import(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:xlsx,xls',
            ],
            [
                'file.required' => 'Hãy chọn một file để tải lên',
                'file.mimes' => 'File không đúng định dạng ( .xlsx, .xls )',
            ]
        );

        try {
            DB::beginTransaction();

            $import = new VoucherImport();
            $import->import($request->file('file'));

            if (count($import->failures()) > 0) {
                $failures = $import->failures();

                foreach ($failures as $failure) {
                    $errorMessages[] = [
                        'row' => $failure->row(),
                        'errors' => $failure->errors(),
                    ];
                }

                DB::rollBack();

                return response()->json([
                    'success' => true,
                    'status' => "422",
                    'errors' => $errorMessages,
                    'message' => 'Dữ liệu không hợp lệ'
                ], 422);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'status' => "200",
                'message' => 'Thêm thành công'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => "500",
                'error' => $e->getMessage(),
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại'
            ], 500);;
        }
    }
}
