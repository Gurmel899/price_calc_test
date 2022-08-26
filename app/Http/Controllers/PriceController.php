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

    public function price(Request $request)
    {

        $gData = $this->goodsData;
        $idGoods = $request->id_goods;
        // $idGoods = $request->$name;
        $data1 = $gData->where("id",$idGoods)->first();
        $dataAll = $data1;
        $locationId = $dataAll["ship_location_id"];
        $weight = $dataAll["weight"];
        $nameGoods = $dataAll["name"];
        $unit = $dataAll["unit"];

        $lData = $this->locationData;
        $data2 = $lData->where("id", $locationId)->first();
        $locType = $data2["fee_location_type"];
        $locName= $data2["location_name"];

        $pData = $this->priceLocation;
        $data3 = $pData->where("location_type", $locType)->first();
        $price = $data3["price"];
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