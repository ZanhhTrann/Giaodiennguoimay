<?php

namespace App\Http\Controllers;

use App\Models\Orders_details;
use App\Models\Products;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class PagesController extends Controller
{
    //Chuyen huong trang den trang mong muon
    // private $proCont=new \App\Http\Controllers\ProductsController();
    private $proCont;

    public function __construct()
    {
        $this->proCont = new \App\Http\Controllers\ProductsController();
    }
    // ham chuyen huong toi route hien thi view
    public function index($page){
        return redirect()->route('pageView',['page'=>$page]);
    }
    // ham lay thong tin url hien tai va tra ve cac tham so head, value,page
    public function __getURL($currentURL){
        $parts = explode('/', $currentURL);
        // Lọc bỏ các phần tử trống (do dấu '/' liền nhau)
        $parts = array_filter($parts);
        // Lấy giá trị từng phần tử
        $head = isset($parts[1]) ? $parts[1] : null; // "/shop"
        $value = urldecode(isset($parts[2]) ? $parts[2] : null); // "T%E1%BA%A5t%20c%E1%BA%A3%20s%E1%BA%A3n%20ph%E1%BA%A9m"
        $sort = urldecode(isset($parts[3]) ? $parts[3] : null);
        $buy = urldecode(isset($parts[4]) ? $parts[4] : null);
        $rent = urldecode(isset($parts[5]) ? $parts[5] : null);
        $page = isset($parts[6]) ? $parts[6] : null; // "1"
        return ['head'=>$head,
                'value'=>$value,
                'sort'=>$sort,
                'buy'=>$buy,
                'rent'=>$rent,
                'page'=>$page
        ];
    }
    // ham hien thi view
    public function __pageView($page){
        if($page==='shop'){
            return redirect()->route('shopView',['value'=>'Tất cả sản phẩm','sort'=>'Mặc định','buy'=>'Tất cả','rent'=>'Tất cả','page'=>1]);
        }
        return view('auth.'.$page.'.'.$page);
    }
    public function __shopView(){
        return view('auth.shop.shop');
    }
    // ham lay doc cac gia tri active duoc gui tu trang shop
    public function sortProducts(Request $req){
        $sort=$req->input('value.sort');
        $buy=$req->input('value.buy');
        $rent=$req->input('value.rent');
        $cid=$req->input('value.cid');
        $page=$req->input('value.page');
        $value=$req->input('value.value');
        $priValue=$req->input('value.priValue');;
        if($value == $priValue){
            $response=$this->proCont->__setup($cid,$sort,$buy,$rent,$page,true);
            // return ['sort'=>$sort,'buy'=>$buy,'rent'=>$rent,'cid'=>$cid,'value'=>$value,'priValue'=>$priValue];
            return view('auth.shop.includes.products.products',compact('response'));
        }
        $response=$this->proCont->__setup($cid,$sort,$buy,$rent,$page,false);
        return view('auth.shop.includes.products.products',compact('response'));
    }

    public function changeSort(Request $request){
        $newPage = $request->input('value.page');
        $value=$request->input('value.value');
        $sort=$request->input('value.sort');
        $buy=$request->input('value.buy');
        $rent=$request->input('value.rent');
        // return ['page'=>$request->input('value')];
        return route('shopView',['value'=>$value,'sort'=>$sort,'buy'=>$buy,'rent'=>$rent,'page'=>$newPage]);
    }
    public function setSort(Request $req){
        session(['sort'=>$req->input('value')]);
        return $req->input('value');
    }
    // chưa sửa
    // Ham update page
    // Ham chuyen doi phan trang
    public function updatePagination(Request $request){
        $newPage = $request->input('value.page');
        $value=$request->input('value.value');
        $sort=$request->input('value.sort');
        $buy=$request->input('value.buy');
        $rent=$request->input('value.rent');
        session(['changePage'=>true]);
        // return ['page'=>$request->input('value')];
        return route('shopView',['value'=>$value,'sort'=>$sort,'buy'=>$buy,'rent'=>$rent,'page'=>$newPage]);
    }

    // hien thi thong tin tom gon cua san pham
    public function getQuickView(Request $request) {
        // Lấy giá trị value từ yêu cầu Ajax
        $product=$this->proCont->__getProductByPid($request->input('pid'));
        return view('auth.shop.includes.quick_view.include.qv_detail', compact('product'));
    }
    // Lay thong tin san pham va hien thi thong tin chi tiet san pham
    public function billDetail($Oid,$ODid,$Pid){
        $detail=Orders_details::where('ODid','=',$ODid,'and','Pid','=',$Pid)->first();
        $product=Products::where('Pid',$Pid)->first();
        return view('auth.bill.bill',compact('detail','product','Oid'));
    }
    // sap xep san pham

}
