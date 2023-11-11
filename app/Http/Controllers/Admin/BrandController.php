<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\CreateBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\FirebaseStorageService;

class BrandController extends Controller
{
    protected $firebaseStorageService;

    public function __construct(FirebaseStorageService $firebaseStorageService)
    {
        $this->middleware('admin');

        $this->firebaseStorageService = $firebaseStorageService;
    }

    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(CreateBrandRequest $request)
    {
        $brand = Brand::create([
            'name' => str()->ucfirst($request->name),
            'slug' => str()->slug(trim($request->name)),
            'status' => $request->status,
        ]);

        $uploadImageResult = $this->firebaseStorageService->uploadImage($request->file('image'), $brand->id, 'brand');
        $brand->avatar = $uploadImageResult['full_url'];
        $brand->avatar_object_name = $uploadImageResult['short_url'];
        $brand->save();

        return redirect()->route('admin.brands.index')->with("success", "Thêm thương hiệu thành công!");
    }

    public function edit(Brand $brand)
    {
        return view('admin.pages.brand.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $redirect = redirect()->back()->with("success", "Cập nhật thông tin thương hiệu thành công!");

        $dataUpdate = [
            'name' => str()->ucfirst($request->name),
            'slug' => str()->slug(trim($request->name)),
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            $uploadImageResult = $this->firebaseStorageService->uploadImage($request->file('image'), $brand->id, 'banner');
            $dataUpdate['avatar'] = $uploadImageResult['full_url'];
            $brand['avatar_object_name'] = $uploadImageResult['short_url'];

            $redirect = $redirect->with('warning', 'Lưu ý: Hình ảnh sẽ mất một ít thời gian để cập nhật lên hệ thống.');
        }

        $brand->update($dataUpdate);

        return $redirect;
    }
}
