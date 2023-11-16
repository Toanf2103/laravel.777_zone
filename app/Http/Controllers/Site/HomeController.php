<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Services\AddressService;
use App\Services\Site\CartService;
use App\Services\Site\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    protected $prodSer;
    public function __construct(ProductService $prodSer)
    {
        $this->prodSer = $prodSer;
    }

    public function home()
    {
        $banners = Banner::where('category_id', null)->where('status', 1)->pluck('image')->toArray();

        // dd($banners);

        return view('site.pages.home', compact('banners'));
    }
    // public function testsasd(){
    //     $add = new AddressService();
    //     $data = $add->getDetailByWardsId(2440);
    //     dd($data);
    // }

    public function search(Request $request)
    {
        $quantityProduct = 9;
        $listProduct = $this->prodSer->findProductsByName($request->get('key') ?? '', $quantityProduct, $request->get('order') ?? null);

        $htrSearch = Session::get('historyKeySearchs') ?? [];
        array_push($htrSearch, $request->get('key'));
        Session::put('historyKeySearchs', $htrSearch);
        Session::save();
        // $rs = Session::get('historyKeySearchs');
        // dd($rs);


        return view('site.pages.search', compact('listProduct'));
    }

    public function category($categorySlug, Request $request)
    {
        $quantityProduct = 9;

        $category = Category::where('slug', $categorySlug)->first();
        if (!$category) {
            return abort(404);
        }

        $listProduct = $this->prodSer
            ->getProductByCategoryPages(
                $category,
                $quantityProduct,
                $request->get('order') ?? null
            );
        $banners = $category->banners->where('status', true)->pluck('image')->toArray();
        return view('site.pages.category', compact('category', 'listProduct', 'banners'));
    }

    public function categoryBrand($categorySlug, $brandSlug, Request $request)
    {
        $quantityProduct = 9;

        $category = Category::where('slug', $categorySlug)->first();
        $brand = Brand::where('slug', $brandSlug)->first();
        $brandCategory = BrandCategory::where('category_id', $category->id)->where('brand_id', $brand->id)->first();

        $listProduct = $this->prodSer
            ->getProductByCategoryBrandPages($brandCategory, $quantityProduct, $request->get('order') ?? null);
        $banners = $category->banners->where('status', true)->pluck('image')->toArray();

        return view('site.pages.category', compact('category', 'brand', 'listProduct', 'banners'));
    }

    function sortProducts($listProduct, $type)
    {
        switch ($type) {
            case 'date':
                return $listProduct->orderBy('created_at');
            case 'price':
                return $listProduct->orderBy('price');
            case 'price_desc':
                return $listProduct->orderBy('price', 'desc');
            default:
                return $listProduct;
        }
    }

    public function product($slug)
    {
        $product = $this->prodSer->getProductBySlug($slug);
        $banners = $product->productimages->pluck('link');
        return view('site.pages.product', compact('product', 'banners'));
    }

    public function cart()
    {
        return view('site.pages.cart');
    }

    public function order(Request $request)
    {
        $rq = $request->all();
        $listProduct = $this->prodSer->getOrderProductsById($rq['prod']);
        // foreach($listProduct as $key=>$product){
        //     $listProduct[$key]['ee'] = ;
        // }

        return view('site.pages.order', compact('listProduct'));
    }

    public function checkout(Request $request)
    {

        $validator =  Validator::make($request->all(),[
            'username' => 'required',
            'phone-number' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'type-pay' => 'required|in:momo,vnay,cod',
            'products' => 'required',

        ]);

        if ($validator->fails()) {
            // Handle validation failure
            // dd(1);
            return redirect()->back()->with('error','Có lỗi !')->withInput();
        }
        // dd(1);
        




        $rq = $request->all();
        dd($rq);
        return view('site.pages.order');
    }
}
