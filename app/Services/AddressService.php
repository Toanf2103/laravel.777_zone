<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;

class AddressService
{
    protected $URL_PROVICE = 'https://provinces.open-api.vn/api/p/';
    protected $URL_DISTRICT = 'https://provinces.open-api.vn/api/d/';
    protected $URL_WARDS = 'https://provinces.open-api.vn/api/w/';


    public function __construct()
    {
    }
    public function getWardsById($id,$depth=1)
    {
        $url = $this->URL_WARDS.$id.'?depth='.$depth;
        $data = $this->callApi($url);
        return $data;
    }
    public function getProviceById($id,$depth=1)
    {
        $url = $this->URL_PROVICE.$id.'?depth='.$depth;
        $data = $this->callApi($url);
        return $data;
    }
    public function getDistrictById($id,$depth=1){
        $url = $this->URL_DISTRICT.$id.'?depth='.$depth;
        $data = $this->callApi($url);
        return $data;
    }
    public function getDetailByWardsId($id){
        $wards = $this->getWardsById($id);
        $district = $this->getDistrictById($wards['district_code']);
        $provice = $this->getProviceById($district['province_code']);
        
        $district['wards'] = $wards;
        $provice['districts'] = $district;
        return $provice;
    }

    function callApi($url){
        try {
          
            $response = Http::get($url);
            if($response->status()==200){
                $data = $response->json();
                return $data;
            }
            return false;
            
           
        } catch (\Exception $e) {
            
            return false;
        }
    }
}
