<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Services\Site\CartService;
use App\Services\Site\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $prodSer;
    public function __construct(ProductService $prodSer)
    {
        $this->prodSer = $prodSer;
    }

    public function home()
    {
        // $rs = Session::get('cart');
        // dd($rs);
        // $carServ = new CartService();
        // $carServ->destroyCart();
        return view('site.pages.home');
    }

    public function search(Request $request){
        $quantityProduct = 9;
        $listProduct=$this->prodSer->findProductsByName($request->get('key')??'',$quantityProduct,$request->get('order')??null);
        
        $htrSearch = Session::get('historyKeySearchs')??[];
        array_push($htrSearch, $request->get('key'));
        Session::put('historyKeySearchs',$htrSearch);
        Session::save();
        // $rs = Session::get('historyKeySearchs');
        // dd($rs);

        
        return view('site.pages.search',compact('listProduct'));
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
        return view('site.pages.category', compact('category', 'listProduct'));
    }

    public function categoryBrand($categorySlug, $brandSlug, Request $request)
    {
        $quantityProduct = 9;

        $category = Category::where('slug', $categorySlug)->first();
        $brand = Brand::where('slug', $brandSlug)->first();
        $brandCategory = BrandCategory::where('category_id', $category->id)->where('brand_id', $brand->id)->first();
        
        $listProduct = $this->prodSer
            ->getProductByCategoryBrandPages($brandCategory, $quantityProduct, $request->get('order') ?? null);

        return view('site.pages.category', compact('category', 'brand', 'listProduct'));
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
        
        return view('site.pages.product',compact('product'));
    }

    public function cart()
    {
        return view('site.pages.cart');
    }
}
