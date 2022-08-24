<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\GoodsData;

class PriceController extends Controller
{
    protected $goodsData;
    protected $locationData;
    protected $priceLocationData;

    public function __construct()
    {
        $this->goodsData = collect(GoodsData::GOODS_DATA);
    }

    public function price()
    {
        return response()->json(
            $this->goodsData,
            200
        );
    }
}
