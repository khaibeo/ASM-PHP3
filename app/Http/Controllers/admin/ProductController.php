<?php

namespace App\Http\Controllers\Admin;

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
        $catalogues = Catalogue::query()->with('children')->orderBy('id','desc')->whereNull('parent_id')->get();
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
        $catalogues = Catalogue::query()->with('children')->orderBy('id','desc')->whereNull('parent_id')->get();
        $product = Product::query()->with(['variants.attributeValues.attribute'])->findOrFail($id);
        $productImages = $product->galleries;

        return view('admin.product.edit', compact('product','productImages','catalogues'));
    }

    public function update(UpdateProductRequest $request, $id)
{
    DB::beginTransaction();

    try {
        $product = Product::findOrFail($id);

        // Cập nhật thông tin cơ bản của sản phẩm
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

        // Xử lý biến thể
        $currentVariantIds = $product->variants->pluck('id')->toArray();
        $updatedVariantIds = [];

        foreach ($request->variants as $variantData) {
            $variantId = $variantData['id'];
            
            // Nếu là biến thể mới (ID bắt đầu bằng 'new_')
            if (strpos($variantId, 'new_') === 0) {
                $variant = new ProductVariant([
                    'product_id' => $product->id,
                    'regular_price' => $variantData['regular_price'],
                    'sale_price' => $variantData['sale_price'],
                    'stock' => $variantData['stock'],
                ]);
                $variant->save();
            } else {
                // Cập nhật biến thể hiện có
                $variant = ProductVariant::findOrFail($variantId);
                $variant->update([
                    'regular_price' => $variantData['regular_price'],
                    'sale_price' => $variantData['sale_price'],
                    'stock' => $variantData['stock'],
                ]);
            }

            $updatedVariantIds[] = $variant->id;

            // Xử lý thuộc tính của biến thể
            $attributeValueIds = [];
            foreach ($variantData['attributes'] as $attributeData) {
                $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);
                $attributeValue = AttributeValue::firstOrCreate(
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
        ProductVariant::whereIn('id', $variantsToDelete)->delete();

        // Xử lý thêm ảnh gallery mới
        if ($request->hasFile('product_galleries')) {
            foreach ($request->file('product_galleries') as $image) {
                $path = $image->store('product_galleries', 'public');
                $product->galleries()->create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        DB::commit();

        return back()->with('success', 'Sản phẩm đã được cập nhật thành công.');
    } catch (\Exception $e) {
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

            // DB::table('variant_attribute_values')
            //     ->whereIn('variant_id', $variantIds)
            //     ->delete();

            // Xóa các sản phẩm khỏi giỏ hàng
            DB::table('cart_items')
                ->whereIn('product_variant_id', $variantIds)
                ->delete();

            // Xóa các product_variants
            // $product->variants()->delete();

            //Xóa ảnh đại diện
            // if($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)){
            //     Storage::disk('public')->delete($product->thumbnail);
            // }

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
