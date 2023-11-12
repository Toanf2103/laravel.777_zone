<?php

namespace App\Services\Site;

use App\Models\Product;
use Exception;

class ProductService
{

    public function getAll($status = null)
    {
        try {
            return Product::where('status', $status)->get();
        } catch (Exception $e) {
            return abort(404);
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $product->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProductBySlug($slug){
        return Product::where('slug', $slug)->first();
    }

    public function findProductById($productId,$status = null){
        try{
            $prod = Product::where('id',$productId);
            if($status !== null){
                $prod = $prod->where('status',$status);
            }
            return $prod;
        }catch (Exception $e){
            return abort(404);
        }
    }

    public function findProductsByName($keyword, $pagination = null,$sort=null){
        try{
            $listProduct = Product::query();

            if ($keyword) {
                $listProduct->where('name', 'like', "%$keyword%");
            }
            if($sort){
                $listProduct = $this->sortProducts($listProduct,$sort);
            }
            if($pagination){
                $listProduct= $listProduct->paginate($pagination);
            }
            return $listProduct;

        }catch(Exception $e){
            return abort(404);
        }
    }

    public function getProductByCategoryPages($category, $pagination = null, $order)
    {
        try {
            $listProduct = Product::whereHas('brandCategory', function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            });

            $listProduct->where('status', true);

            if ($order) {
                $listProduct =  $this->sortProducts($listProduct, $order);
            }

            if ($pagination) {
                $listProduct = $listProduct->paginate($pagination);
            }
            return $listProduct;
        } catch (Exception $e) {
            return abort(404);
        }
    }

    public function getProductByCategoryBrandPages($brandCategory, $pagination = null, $order)
    {
        try {
            $listProduct = Product::where('status', true)->where('brand_category_id', $brandCategory->id);

            if ($order) {
                $listProduct =  $this->sortProducts($listProduct, $order);
            }
            if ($pagination) {
                $listProduct = $listProduct->paginate($pagination);
            }

            return $listProduct;
        } catch (Exception $e) {
            return abort(404);
        }
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
}
