<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class AddressService
{
    protected $URL_PROVINCE = 'https://provinces.open-api.vn/api/p/';
    protected $URL_DISTRICT = 'https://provinces.open-api.vn/api/d/';
    protected $URL_WARDS = 'https://provinces.open-api.vn/api/w/';

    public function getWardsById($id, $depth = 1)
    {
        $url = $this->URL_WARDS . $id . '?depth=' . $depth;
        $data = $this->callApi($url);

        return $data;
    }

    public function getProvinceById($id, $depth = 1)
    {
        $url = $this->URL_PROVINCE . $id . '?depth=' . $depth;
        $data = $this->callApi($url);

        return $data;
    }

    public function getDistrictById($id, $depth = 1)
    {
        $url = $this->URL_DISTRICT . $id . '?depth=' . $depth;
        $data = $this->callApi($url);

        return $data;
    }

    public function getDetailByWardId($id)
    {
        $wards = $this->getWardsById($id);
        $district = $this->getDistrictById($wards['district_code']);
        $province = $this->getProvinceById($district['province_code']);

        $district['wards'] = $wards;
        $province['districts'] = $district;

        return $province;
    }
    public function getNameAdress($id)
    {
        $wards = $this->getWardsById($id);
        $district = $this->getDistrictById($wards['district_code']);
        $province = $this->getProvinceById($district['province_code']);
        return $wards['name'] . ' - ' .$district['name'].' - '.$province['name'];
    }
    public static function callApi($url)
    {
        try {
            $response = Http::get($url);
            if ($response->status() == 200) {
                $data = $response->json();
                return $data;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
