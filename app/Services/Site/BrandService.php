<?php

namespace App\Services\Site;

use App\Models\Brand;
use Exception;

class BrandService
{

    public function getAll($status = null)
    {
        try {
            if($status !== null){
                return Brand::all();
            }
            return Brand::where('status', $status)->get();
        } catch (Exception $e) {
            return abort(404);
        }
    }
    public function getById($brandId,$status=null){
        try {
            $brand = Brand::where('brand_id', $brandId);
            if($status !== null){
                $brand = $brand->where('status', $status);
            }
            return $brand;
        } catch (Exception $e) {
            return abort(404);
        }
    }

    
}
