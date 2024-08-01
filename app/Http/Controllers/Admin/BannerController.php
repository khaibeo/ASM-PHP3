<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderDetail;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::with('details')->get();
        return view('admin.banner.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url.*' => 'nullable|url',
            'position.*' => 'required|integer|distinct|between:1,5',
        ], [
            'position.*.distinct' => 'Các vị trí phải khác nhau.',
            'position.*.between' => 'Vị trí phải nằm trong khoảng từ 1 đến 5.',
            'image_url.*.required' => 'Phải chọn ảnh.',
            'image_url.*.image' => 'Tệp tải lên phải là ảnh.',
            'image_url.*.mimes' => 'Tệp tải lên phải là ảnh.',
            'link_url.*.url' => 'Lưu ý gắn đường link'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('slide_count', count($request->image_url));
        }
        // Kiểm tra tổng số ảnh không vượt quá 5
        if (count($request->image_url) > 5) {
            return back()->withErrors(['image_url' => 'Chỉ được phép thêm tối đa 5 ảnh.'])->withInput();
        }

        $banner = Slider::create($request->only('title'));

        if ($request->has('image_url')) {
            foreach ($request->image_url as $key => $file) {
                $filename = 'banners/' . time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public', $filename);

                SliderDetail::create([
                    'slider_id' => $banner->id,
                    'image_url' => $filename,
                    'link_url' => $request->link_url[$key] ?? null,
                    'position' => $request->position[$key]
                ]);
            }
        }

        return redirect()->route('admin.banners.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Slider::with('details')->findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Slider::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image_url.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url.*' => 'nullable|url',
            'position.*' => 'required|integer|distinct|between:1,5',
        ], [
            'position.*.distinct' => 'Các vị trí phải khác nhau.',
            'position.*.between' => 'Vị trí phải nằm trong khoảng từ 1 đến 5.',
            'image_url.*.image' => 'Tệp tải lên phải là ảnh.',
            'image_url.*.mimes' => 'Tệp tải lên phải là ảnh.',
            'link_url.*.url' => 'Lưu ý gắn đường link hợp lệ'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cập nhật thông tin slide chính
        $banner->title = $request->input('title');
        $banner->save();

        // Xóa các ảnh đã được đánh dấu để xóa
        $deletedIds = $request->input('deleted_slides', []);
        foreach ($deletedIds as $deleteId) {
            $detail = SliderDetail::find($deleteId);
            if ($detail) {
                if ($detail->image_url && Storage::exists('public/' . $detail->image_url)) {
                    Storage::delete('public/' . $detail->image_url);
                }
                $detail->delete();
            }
        }

        // Cập nhật hoặc thêm mới các chi tiết của slide
        $existingIds = $request->input('existing_slide_ids', []);
        $newSlides = $request->input('new_slides', []);

        foreach ($existingIds as $detailId) {
            $detail = SliderDetail::find($detailId);
            if ($detail && !in_array($detailId, $deletedIds)) {
                if ($request->hasFile('image_url.' . $detailId)) {
                    if ($detail->image_url && Storage::exists('public/' . $detail->image_url)) {
                        Storage::delete('public/' . $detail->image_url);
                    }
                    $image = $request->file('image_url.' . $detailId);
                    $imageName = 'banners/' . time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public', $imageName);
                    $detail->image_url = $imageName;
                }
                $detail->link_url = $request->input('link_url.' . $detailId);
                $detail->position = $request->input('position.' . $detailId);
                $detail->save();
            }
        }

        foreach ($newSlides as $index => $newSlide) {
            if ($request->hasFile('image_url.new_' . $index)) {
                $image = $request->file('image_url.new_' . $index);
                $imageName = 'banners/' . time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public', $imageName);
                SliderDetail::create([
                    'slider_id' => $banner->id,
                    'image_url' => $imageName,
                    'link_url' => $request->input('link_url.new_' . $index),
                    'position' => $request->input('position.new_' . $index),
                ]);
            }
        }

        return redirect()->route('admin.banners.index')->with('success', 'Slide đã được cập nhật thành công!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $banner = Slider::findOrFail($id);

        if ($banner->active) {
            return redirect()->back()->with('error', 'Không thể xóa slide đang hoạt động.');
        }


        if ($id == 8) {
            return redirect()->back()->with('error', 'Không thể xóa slide mặc định.');
        }


        $banner->delete();

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.banners.index')->with('success', 'Slide đã được xóa thành công.');
    }

    public function updateStatus($id)
    {
        // Tìm slider theo ID
        $banner = Slider::findOrFail($id);

        // Lấy tất cả các slide đang hoạt động
        $activeSlides = Slider::where('active', true)->count();

        // Chuyển đổi trạng thái
        if ($banner->active && $activeSlides <= 1) {
            return redirect()->back()->with('error', 'Bạn không thể vô hiệu hóa slide này vì phải có ít nhất một slide đang hoạt động.');
        }

        Slider::where('active', true)->update(['active' => false]);

        // Kích hoạt slide hiện tại
        $banner->active = true;
        $banner->save();
        // Nếu không có slide nào hoạt động, kích hoạt slide với ID là 1
        if (Slider::where('active', true)->count() === 0) {
            $defaultSlide = Slider::find(8);
            if ($defaultSlide) {
                $defaultSlide->active = true;
                $defaultSlide->save();
            }
        }

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.banners.index')->with('success', 'Trạng thái slide đã được cập nhật!');
    }
}
