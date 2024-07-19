<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\catalogues;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //$list_catalogue = DB::table('catalogues')->get();
    //     $list_catalogue = DB::table('catalogues as c1')
    //     ->leftJoin('catalogues as c2', 'c1.parent_id', '=', 'c2.id')
    //     ->select('c1.id', 'c1.name', 'c1.image', 'c1.is_active','c1.created_at', 'c2.name as parent_name')
    //     ->get();
    //     return view('admin.catalogue.index',['listcata'=>$list_catalogue]);

    // }
    public function index()
    {
        $catalogues = catalogues::with('children')->whereNull('parent_id')->get();
        return view('admin.catalogue.index', compact('catalogues'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues = DB::table('catalogues')->get();
        return view('admin.catalogue.add', ['catalouges' => $catalogues]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image',
        ], [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Trường tên phải là chuỗi.',
            'name.max' => 'Trường tên không được vượt quá 100 ký tự.',
            'image.required' => 'Trường hình ảnh là bắt buộc.',
            'image.image' => 'Trường hình ảnh phải là một file ảnh.'
        ]);
        $validate['parent_id'] = $request->input('parent_id') === '0' ? null : $request->input('parent_id');
        $validate['is_active'] = $request->input('is_active') === '1' ? 1 : 0;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
            $validate['image'] = $imagePath;
        }

        DB::table('catalogues')->insert([
            'name' => $validate['name'],
            'image' => $validate['image'],
            'parent_id' => $validate['parent_id'],
            'is_active' => $validate['is_active'], // giá trị mặc định
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được thêm thành công');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $catalogue = DB::table('catalogues')->where('id', $id)->first();
        $catalogues = DB::table('catalogues')->get();
        if (!$catalogue) {
            return redirect()->route('admin.catalogues.index')->with('error', 'Danh mục không tồn tại');
        }
        //dd($catalogue);
        //dd($catalogues);
        return view('admin.catalogue.edit', ['catalogue' => $catalogue, 'catalogues' => $catalogues]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'image',
        ], [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Trường tên phải là chuỗi.',
            'name.max' => 'Trường tên không được vượt quá 100 ký tự.',
            'image.required' => 'Trường hình ảnh là bắt buộc.',
            'image.image' => 'Trường hình ảnh phải là một file ảnh.'
        ]);
        $validatedData['parent_id'] = $request->input('parent_id') === '0' ? null : $request->input('parent_id');
        $validatedData['is_active'] = $request->input('is_active') === '1' ? 1 : 0;

        $imagePath = DB::table('catalogues')->where('id', $id)->value('image');

        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('product', 'public');
        }

        DB::table('catalogues')->where('id', $id)->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'parent_id' => $validatedData['parent_id'],
            'is_active' =>  $validatedData['is_active'],
            'updated_at' => now()
        ]);
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = DB::table('catalogues')->where('id',$id)->first();

        if(!$catalogue){
            return redirect()->route('admin.catalogues.index')->with('success', 'ID không tồn tại');
        }

        if($catalogue->image && Storage::disk('public')->exists($catalogue->image)){
            Storage::disk('public')->delete($catalogue->image);
        }

        DB::table('catalogues')->where('id',$id)->delete();
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được xóa thành công');
    }
}
