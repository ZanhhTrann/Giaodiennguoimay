<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Order_status;
use App\Models\Orders;
use App\Models\Orders_details;
use App\Models\Payment_methods;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function Pay(Request $request){
        // dd($request);
        $selectedUCids = $request->input('selectedUCids');
        session(['payment'=>['UCids' => $selectedUCids]]);
        return  response()->json(['redirectUrl' => route('pages.index',['page'=>'pay'])]);
    }

    public function getCity(){
        return City::all();
    }

    public function getDistrict(Request $request){
        $cityId = $request->input('cityId');
        $districts=District::where('id_tp',(int)$cityId)->get();
        return view('auth.pay.includes.districtChoise', compact('districts'));
        // return response()->json($request->input('cityId'));
        // return true;
    }
    public function getTown(Request $request){
        $districtId = $request->input('districtId');
        $towns=Town::where('id_qh',(int)$districtId)->get();
        return view('auth.pay.includes.townChoise', compact('towns'));
        // return response()->json($request->input('districtId'));
        // return true;
    }

    public function getPayMethod(){
        return Payment_methods::all();
    }
    public function payment(Request $request){
        // dd($request);
        $carts=session('payment')['UCids'];
        $nameOrder=$request->input('name');
        $phone=$request->input('phone');
        $id_tp=$request->input('id_tp');
        $id_qh=$request->input('id_qh');
        $id_xp=$request->input('id_xp');
        $street=$request->input('street');
        $address=$request->input('address');
        $note=$request->input('note');
        $PMid=$request->input('payment_method');
        $total=$request->input('total');
        $SMid=$request->input('ship_id');
        $userC=new \App\Http\Controllers\UserController();
        $cartOrders=$userC->getCartOrder();
        $total=0;
        $order = Orders::create([
            'Uid'=>session('login')['user_id'],
            'PMid'=>$PMid,
            'SPid'=>$SMid,
            'Order_name'=>$nameOrder,
            'Phone_number'=>$phone,
            'id_tp'=>$id_tp,
            'id_qh'=>$id_qh,
            'id_xp'=>$id_xp,
            'street'=>$street,
            'address'=>$address,
            'note'=>$note,
            'Total_products'=>count($carts),
            'Total_order_price'=>$total,
        ]);
        if (!$order) {
            // Xử lý lỗi khi tạo order
            return redirect()->back()->with('error', 'Failed to create order.');
        }
        foreach ($cartOrders as $value) {
            // dd($value->size);
            $Odd=Orders_details::create([
                'Oid'=>$order->Oid,
                'Pid'=>$value->Pid,
                'color'=>$value->color,
                'size'=>$value->size,
                'Quantily'=>$value->quantity,
                'PPatToO'=>$value->Price
            ]);
            // dd($Odd->color,$Odd->size,$Odd);
            Order_status::create([
                'Oid'=>$order->Oid,
                'ODid'=>$Odd->ODid,
                'Status'=>0
            ]);
            $userC->DelelteProductCart($value->UCid);
        }
        Session::forget('payment');
        return redirect()->route("pages.index",['page'=>'thanks']);

    }
    public function getOrderDetail() {
        $Oids = Orders::select('Oid')->where("Uid", session('login')['user_id'])->get()->pluck('Oid');
        return Orders_details::whereIn('Oid', $Oids)->orderBy('Oid', 'desc')->get();
    }
    public function getOrderStatusById($ODid){
        return Order_status::select('Status')->where('ODid',$ODid)->first();
    }
    public function CancelOrder($ODid){
        $order=Order_status::where('ODid',$ODid)->first();
        $order->Status=-1;
        $order->save();
        return redirect()->back()->with('success','');
    }
    public function sucssetOrder($ODid){
        $order=Order_status::where('ODid',$ODid)->first();
        $order->Status=1;
        $order->save();
        return redirect()->back()->with('success','');
    }
}
