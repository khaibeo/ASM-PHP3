<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\products\StoreProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Models\Catalogue;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('id', 'desc')->get();
        return view('admin.product.index', compact('products'));
    }

    public function add()
    {
        $catalogues = Catalogue::all();
        return view('admin.product.add',['catalogues'=>$catalogues]);
    }

    public function store(StoreProductRequest $request)
    {        
        $validatedData = $request->except('_token', 'product_galleries');

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $dataProductGalleries = $request->product_galleries ?? [];

        try {
            DB::beginTransaction();
            $product = Product::create([
                'name' => $validatedData['name'],
                'sku' => $validatedData['sku'],
                'slug' => Str::slug($validatedData['slug']),
                'description' => $validatedData['description'],
                'short_description' => $validatedData['short_description'],
                'regular_price' => $validatedData['regular_price'],
                'sale_price' => $validatedData['sale_price'],
                'catalogue_id' => $validatedData['catalogue_id'],
                'thumbnail' => $validatedData['thumbnail'],
                'is_active' => $validatedData['is_active'],
                'is_featured' => $validatedData['is_featured'],
                'is_featured' => $validatedData['is_featured'],
            ]);

            foreach ($validatedData['variants'] as $variantData) {
                $variant = $product->variants()->create([
                    'sale_price' => $variantData['sale_price'],
                    'regular_price' => $variantData['regular_price'],
                    'stock' => $variantData['stock'],
                ]);

                foreach ($variantData['attributes'] as $attributeData) {
                    $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);
                    $attributeValue = AttributeValue::firstOrCreate([
                        'attribute_id' => $attribute->id,
                        'value' => $attributeData['value'],
                    ]);
                    $variant->attributeValues()->attach($attributeValue->id);
                }
            }

            foreach ($dataProductGalleries as $item) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::disk('public')->put('products', $item)
                ]);
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
        } catch (\Exception $exception) {
            if ($request->hasFile('thumbnail') && Storage::disk('public')->exists($validatedData['thumbnail'])) {
                Storage::disk('public')->delete($validatedData['thumbnail']);
            }
            DB::rollBack();
            throw $exception;
        }
    }

    public function edit($id)
    {
        $catalogues = Catalogue::all();
        $product = Product::query()->with(['variants.attributeValues.attribute'])->findOrFail($id);
        $productImages = $product->galleries;

        return view('admin.product.edit', compact('product','productImages','catalogues'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            $product->update([
                'name' => $request->name,
                'sku' => $request->sku,
                'slug' => $request->slug,
                'regular_price' => $request->regular_price,
                'sale_price' => $request->sale_price,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'catalogue_id' => $request->catalogue_id,
                'is_active' => $request->is_active,
                'is_featured' => $request->is_featured,
            ]);

            // Cập nhật ảnh đại diện nếu có
            if ($request->hasFile('thumbnail')) {
                if($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)){
                    Storage::disk('public')->delete($product->thumbnail);
                }

                $thumbnailPath = $request->file('thumbnail')->store('products', 'public');
                
                $product->thumbnail = $thumbnailPath;
                $product->save();
            }

            // Lấy tất cả ID của các biến thể hiện tại
            $currentVariantIds = $product->variants->pluck('id')->toArray();
            $updatedVariantIds = [];

            // Cập nhật hoặc tạo mới các biến thể
            foreach ($request->variants as $variantData) {
                $variant = ProductVariant::updateOrCreate(
                    ['id' => $variantData['id'] ?? null, 'product_id' => $product->id],
                    [
                        'regular_price' => $variantData['regular_price'],
                        'sale_price' => $variantData['sale_price'],
                        'stock' => $variantData['stock'],
                    ]
                );

                $updatedVariantIds[] = $variant->id;

                // Cập nhật hoặc tạo mới các thuộc tính
                $attributeValueIds = [];
                foreach ($variantData['attributes'] as $attributeData) {
                    $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);
                    $attributeValue = AttributeValue::updateOrCreate(
                        ['attribute_id' => $attribute->id, 'value' => $attributeData['value']],
                        ['value' => $attributeData['value']]
                    );
                    $attributeValueIds[] = $attributeValue->id;
                }

                // Đồng bộ hóa attribute values với variant
                $variant->attributeValues()->sync($attributeValueIds);
            }

            // Xóa các biến thể không còn tồn tại trong request
            $variantsToDelete = array_diff($currentVariantIds, $updatedVariantIds);
            foreach ($variantsToDelete as $variantId) {
                $variant = ProductVariant::find($variantId);
                if ($variant) {
                    // Xóa các bản ghi liên quan trong bảng variant_attribute_values
                    $variant->attributeValues()->detach();
                    // Sau đó xóa biến thể
                    $variant->delete();
                }
            }

            // Xử lý thêm ảnh gallery mới
            if ($request->hasFile('product_galleries')) {
                $oldGalleries = $product->galleries;
                foreach ($request->file('product_galleries') as $image) {
                    $path = $image->store('product_galleries', 'public');
                    $product->galleries()->create([
                        'product_id' => $product->id,
                        'image' => $path
                    ]);
                }

                foreach ($oldGalleries as $item) {
                    ProductGallery::query()->where('id',$item->id)->delete();
                    Storage::disk('public')->delete($item->image);
                }
            }

            DB::commit();

            return back()->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            if ($request->hasFile('thumbnail')) {
                if($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)){
                    Storage::disk('public')->delete($product->thumbnail);
                }

                $errorImage = $request->file('thumbnail');
                if(Storage::disk('public')->exists($errorImage)){
                    Storage::disk('public')->delete($errorImage);
                }
            }

            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật sản phẩm: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            // Xóa các variant_attribute_values liên quan
            $variantIds = $product->variants->pluck('id')->toArray();
            DB::table('variant_attribute_values')
                ->whereIn('variant_id', $variantIds)
                ->delete();

            // Xóa các product_variants
            $product->variants()->delete();

            //Xóa ảnh đại diện
            if($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)){
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Xóa sản phẩm
            $product->delete();

            DB::commit();

            return back()->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
        }
    }
}
