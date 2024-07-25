<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderDetail;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url.*' => 'nullable|url',
            'position.*' => 'required|integer|distinct|between:1,5',
        ], [
            'position.*.distinct' => 'Các vị trí phải khác nhau.',
            'position.*.between' => 'Vị trí phải nằm trong khoảng từ 1 đến 5.',
            'image_url.*.required' => 'Phải chọn ảnh.',
            'image_url.*.image' => 'Tệp tải lên phải là ảnh.',
            'image_url.*.mines' => 'Tệp tải lên phải là ảnh.',
            'link_url.*.url' => 'Lưu ý gắn đường link'
        ]);

        // Kiểm tra tổng số ảnh không vượt quá 3
        if (count($request->image_url) > 5) {
            return back()->withErrors(['image_url' => 'Chỉ được phép thêm tối đa 5 ảnh.'])->withInput();
        }

        $banner = Slider::create($request->only('title'));

        if ($request->has('image_url')) {
            foreach ($request->image_url as $key => $image) {
                $imagePath = $image->store('banners');
                
                SliderDetail::create([
                    'slider_id' => $banner->id,
                    'image_url' => $imagePath,
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

        // Cập nhật thông tin slide chính
        $banner->title = $request->input('title');
        $banner->save();

        // Xóa các ảnh không còn tồn tại
        if ($request->has('delete_image_ids')) {
            foreach ($request->input('delete_image_ids') as $deleteId) {
                $detail = SliderDetail::find($deleteId);
                if ($detail) {
                    // Xóa ảnh từ storage
                    if ($detail->image_url && Storage::exists($detail->image_url)) {
                        Storage::delete($detail->image_url);
                    }
                    $detail->delete();
                }
            }
        }

        // Cập nhật các chi tiết của slide
        foreach ($request->input('position') as $detailId => $position) {
            $detail = SliderDetail::find($detailId);

            if ($request->hasFile('image_url.' . $detailId)) {
                // Xóa ảnh cũ nếu có
                if ($detail->image_url && Storage::exists($detail->image_url)) {
                    Storage::delete($detail->image_url);
                }

                $image = $request->file('image_url.' . $detailId);
                $imageName = $image->getClientOriginalName(); // Lấy tên gốc của file
                $imagePath = $image->storeAs('banners', $imageName, 'public');
                $detail->image_url = $imagePath;
            } else {
                $detail->image_url = $request->input('old_image_url.' . $detailId);
            }

            $detail->link_url = $request->input('link_url.' . $detailId);
            $detail->position = $position;
            $detail->save();
        }

        // Thêm mới ảnh nếu cần và số lượng ảnh chưa đạt giới hạn
        if (count($banner->details) < 5) {
            $newImageUrls = $request->file('new_image_url');
            if ($newImageUrls) {
                $count = 0;
                foreach ($newImageUrls as $index => $file) {
                    if ($count >= 5 - count($banner->details)) {
                        break;
                    }

                    if ($file) {
                        $imageName = $image->getClientOriginalName(); // Lấy tên gốc của file
                        $imagePath = $image->storeAs('banners', $imageName, 'public');
                        SliderDetail::create([
                            'banner_id' => $banner->id,
                            'image_url' => $imagePath,
                            'link_url' => $request->input('new_link_url')[$index],
                            'position' => $request->input('new_position')[$index],
                        ]);
                        $count++;
                    }
                }
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
