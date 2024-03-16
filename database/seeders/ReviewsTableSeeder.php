<?php

namespace Database\Seeders;

use App\Models\Order_status;
use App\Models\Orders;
use App\Models\Orders_details;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $reviews=['Sản phẩm rất đẹp, shop tư vấn nhiệt tình....','Quá đẹp, shop tư vấn rất nhiệt tình...','Thấy sản phẩm được đánh giá tốt nên mua thử và rất hài lòng...',
        'Đẹp không có gì để chê...','Shop nhiệt tình','Shop tư vấn nhiệt tình, sản phẩm nhận được giống mẫu và vừa vặn','Rất ok sẽ mua lại lần sau nếu có cơ hội...'
    ];
        $faker = Faker::create();
        $users=User::get();
        foreach($users as $user){
            $products = Products::inRandomOrder()->limit(rand(10,20),)->get();
            $order= Orders::create([
                    'Uid' => $user->Uid,
                    'Order_name' => $user->Name,
                    'Type' => rand(1,3),
                    // 'comment' => $faker->paragraph,
                    'Total_products'=>count($products)
            ]);
            foreach ($products as $product){
                $sizes = array_filter(explode("_",$product->Sizes));
                $randomKey = array_rand($sizes);
                // Lấy giá trị tương ứng với key ngẫu nhiên
                $randomSize = $sizes[$randomKey];
                $order_detail=Orders_details::create([
                    'Oid'=>$order->Oid,
                    'Pid'=>$product->Pid,
                    'color'=>'Kem',
                    'size'=>$randomSize
                ]);
                Order_status::create([
                    'Oid'=>$order->Oid,
                    'ODid'=>$order_detail->ODid,
                    'Status'=>1
                ]);
                $randomKey = array_rand($reviews);
                // Lấy giá trị tương ứng với key ngẫu nhiên
                $randomRev = $reviews[$randomKey];
                Reviews::create([
                    'Pid'=>$product->Pid,
                    'Uid'=>$user->Uid,
                    'Img'=>$product->Main_image,
                    'reviews'=>$randomRev,
                ]);
            }
        }
    }
}
