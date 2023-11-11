<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(5);

        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => str()->ucfirst($request->name),
            'slug' => str()->slug(trim($request->name)),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with("success", "Thêm danh mục thành công!");
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => str()->ucfirst($request->name),
            'slug' => str()->slug(trim($request->name)),
            'status' => $request->status,
        ]);

        return redirect()->back()->with("success", "Cập nhật danh mục thành công!");
    }
}
