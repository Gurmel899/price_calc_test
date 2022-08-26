<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\GoodsData;
use App\Data\PriceLocationType;
use App\Data\LocationData;

class PriceController extends Controller
{
    protected $goodsData;
    protected $locationData;
    protected $priceLocation;

    public function __construct()
    {
        $this->goodsData = collect(GoodsData::GOODS_DATA);
        $this->priceLocation = collect(PriceLocationType::PRICE_LOCATION_TYPE);
        $this->locationData = collect(LocationData::LOCATION_DATA);
    }

    public function price()
    {

        $gData = $this->goodsData;
        $data1 = $gData->where("id", "0f4ab946-a581-4400-a501-29df053a431b")->all();
        $dataAll = $data1[1];
        $locationId = $dataAll["ship_location_id"];
        $weight = $dataAll["weight"];
        $nameGoods = $dataAll["name"];
        $unit = $dataAll["unit"];

        $lData = $this->locationData;
        $data2 = $lData->where("id", $locationId)->all();
        $locType = $data2[2]["fee_location_type"];
        $locName= $data2[2]["location_name"];

        $pData = $this->priceLocation;
        $data3 = $pData->where("location_type", $locType)->all();
        $price = $data3[0]["price"];
        $pricegoods = $price * $weight;

        $result =[
            "name"=>$nameGoods,
            "weight"=>$weight,
            "unit"=>$unit,
            "price total"=>$pricegoods,
            "ship location"=>$locName,
        ];
        return response()->json($result);




        return response()->json(
        $this->goodsData,
        200
        );
    }


}