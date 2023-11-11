<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\CreateBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\FirebaseStorageService;

class BannerController extends Controller
{
    protected $firebaseStorageService;

    public function __construct(FirebaseStorageService $firebaseStorageService)
    {
        $this->middleware('admin');

        $this->firebaseStorageService = $firebaseStorageService;
    }

    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->paginate(5);

        return view('admin.pages.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.banner.create');
    }

    public function store(CreateBannerRequest $request)
    {
        $banner = Banner::create([
            'category_id' => $request->input('category'),
            'link' => $request->input('link'),
            'status' => $request->status,
        ]);

        $uploadImageResult = $this->firebaseStorageService->uploadImage($request->file('image'), $banner->id, 'banner');
        $banner->image = $uploadImageResult['full_url'];
        $banner->image_object_name = $uploadImageResult['short_url'];
        $banner->save();

        return redirect()->route('admin.banners.index')->with("success", "Thêm banner thành công!");
    }

    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->update([
            'category_id' => $request->input('category'),
            'link' => $request->input('link'),
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $uploadImageResult = $this->firebaseStorageService->uploadImage($request->file('image'), $banner->id, 'banner');
            $banner->image = $uploadImageResult['full_url'];
            $banner->image_object_name = $uploadImageResult['short_url'];
            $banner->save();
        }

        return redirect()->back()->with("success", "Cập nhật banner thành công! Lưu ý: Hình ảnh sẽ mất một ít thời gian để cập nhật lên hệ thống.");
    }
}
