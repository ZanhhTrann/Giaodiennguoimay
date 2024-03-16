<?php

namespace App\Http\Controllers;

use App\Models\Order_status;
use App\Models\Orders;
use App\Models\Orders_details;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function __getOrderByID($Pid,$Uid) {
        $order = Orders::where('Uid', $Uid)->first();
        $order_detail=Orders_details::where('Oid',$order->Oid)->where('Pid',$Pid)->first();
        $order_status=Order_status::where('ODid',$order_detail->ODid)->first();
        return ['order'=>$order,'order_detail'=>$order_detail,'order_status'=>$order_status];
    }
}
