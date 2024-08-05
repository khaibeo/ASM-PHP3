<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id == 1) {
            return response()->json(['error' => 'Không thể xóa danh mục này'], 403);
        }
        $catalogue = Catalogue::findOrFail($id);

        // Cập nhật danh mục con cấp đầu
        Catalogue::where('parent_id', $catalogue->id)->update(['parent_id' => null]);
    
        // Chuyển các sản phẩm của danh mục bị xóa sang danh mục có id là 1
        Product::where('catalogue_id', $catalogue->id)->update(['catalogue_id' => 1]);

        if($catalogue->image && Storage::disk('public')->exists($catalogue->image)){
            Storage::disk('public')->delete($catalogue->image);
        }

        Catalogue::query()->find($id)->delete();
        return response()->json(['success'=>'Danh mục đã được xóa thành công']);
    }
}
