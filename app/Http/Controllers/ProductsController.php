<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // lay san pham theo ma san pham
    public function __getProductByPid($pid){
        return Products::where('Pid',$pid)->first();
    }
    // ham cap nhap lai thong tin session san pham
    public function __updateSession($cid,$pages,$products){
        session(['shopView' => array_merge(session('shopView'), [
            'products_' . $cid => $products,
            'pages_'.$cid => $pages
        ])]);
    }

    // Lay danh sach danh gia san pham
    public function getReviewsbyId($Pid){
        $reviews=Reviews::where('Pid',$Pid)->get();
        $revUids=Reviews::select('Uid')->where('Pid',$Pid)->get();
        $users_name=User::select('Name')->whereIn('Uid',$revUids)->get();
        // dd($users_name);
        return ['reviews'=>$reviews,
                'users_name'=>$users_name];
    }
    // thay doi gia tri cua chuoi de truy van
    private function changePrice($string){
        $gia_tri = explode('-', $string);
        $so_tu = preg_replace('/[^0-9.]/', '', $gia_tri);
        // Chuyển đổi giá trị số thành định dạng mong muốn
        $gia_tri_formatted = array_map(function($value) {
            // return $value;
            return number_format((double)$value * 1000000, 0, '', '');
        }, $so_tu);
        return $gia_tri_formatted;
    }
    private function setQuery($cid,$sort,$buy,$rent){
        $value=($buy!="Tất cả"?$buy:$rent);
        $column=($buy!="Tất cả"?'Price':'Rent_cost');
        // conditon dieu kien lon nho
        $priceSort = strpos($sort, 'Thấp đến cao') !== false ? 'ASC' : 'DESC';
        $sort=(strpos($sort, 'Giá')==false? $sort:'Giá');
        $cond=(strpos($value, 'Dưới')!==false?'<':(strpos($value, 'Trên')!==false?'>':($value=="Tất cả"?'':'-')));
        $query = Products::when($cid != '0000', function ($query) use ($cid) {
            return $query->where('Cid', $cid);
        });
        if ($sort == 'Phổ biến') {
            $query->select('Products.*')
                ->leftJoin('Order_detail', 'Products.Pid', '=', 'order_detail.Pid')
                ->groupBy('Products.Pid')
                ->orderByRaw('COUNT(Order_detail.Pid) DESC');
        }
        if ($sort == 'Giá') {
            $query->orderBy('Price', $priceSort);
        }
        if ($sort == 'Đồ mới') {
            $query->orderBy('Pid', 'DESC');
        }
        if ($sort == 'Đánh giá') {
            $query->select('Products.*')
                ->leftJoin('Reviews', 'Products.Pid', '=', 'Reviews.Pid')
                ->groupBy('Products.Pid')
                ->orderByRaw('AVG(Reviews.rate) DESC');
        }
        if($cond=='-'){
            return $query->whereBetween($column,$this->changePrice($value))->get();
        }
        if($cond==''){
            return $query->inRandomOrder()->get();
        }
        return $query->where($column,$cond,$this->changePrice($value))->get();
    }
    private function Sort($cid,$sort,$buy,$rent,$reload){
        // kiem tra co dang thuc hien chuyen phan trang san pham hay khong
        if(session('changePage')==true){
            session(['changePage'=>false]);
            return session('shopView')['products_'.$cid];
        }
        if($reload==true){
            return $this->setQuery($cid,$sort,$buy,$rent);
        }
        if(session()->has('sort')){
            if($cid===session('sort')){
                session()->forget('sort');
            }
            return $this->setQuery($cid,$sort,$buy,$rent);
        }

        if(isset(session('shopView')['products_'.$cid])){
            return session('shopView')['products_'.$cid];
        }
        // return [];
        return $this->setQuery($cid,$sort,$buy,$rent);
    }

    // ham setup thong tin san pham
    public function __setup($cid,$sort,$buy,$rent,$page,$reload){
        if(!session()->has('shopView')){
            session(['shopView'=>[]]);
        }
        $perPage = 12;
        $products=$this->Sort($cid,$sort,$buy,$rent,$reload);
        $pages = ceil(count($products) / $perPage);
        $start = ($page - 1) * $perPage;
        $this->__updateSession($cid,$pages,$products);
        return ['visible'=>collect($products)->slice($start, $perPage)->all(),'pages'=>$pages,'page'=>$page];
    }

}
