<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping_methods;
class ShippingController extends Controller
{
    //
    public function getShippings(){
        return Shipping_methods::all();
    }
    public function getShipbyId(){
        return Shipping_methods::where("SMid",session('payment')['select'])->first();
    }
}
