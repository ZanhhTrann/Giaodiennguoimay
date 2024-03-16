<?php

namespace App\Console\Commands;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Console\Command;

class ImportDress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {folderPath : "C:\Users\VivoBook\Downloads\Váy cưới"}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $folderPath = $this->argument('folderPath');

    // Lấy danh sách thư mục con
    $directories = array_diff(scandir($folderPath), ['.', '..']);

    // Thêm dữ liệu từ mỗi thư mục con vào cơ sở dữ liệu products
    foreach ($directories as $directory) {
        $files = array_diff(scandir($folderPath . DIRECTORY_SEPARATOR . $directory), ['.', '..']);
        $cat=Categories::where('Categories_name',$directory)->first();
        foreach ($files as $file) {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file;
            $imageContent = file_get_contents($filePath);
            $price=round(rand(10000000, 30000000) / 100000) * 100000;
            if($cat->Categories_name=='Giày cưới'){
                $sd='Chào mừng bạn đến với chiếc giày cưới "'.($cat->Categories_name . ' ' . pathinfo($file, PATHINFO_FILENAME)).'" - sản phẩm hoàn hảo để tôn lên vẻ đẹp tinh tế và quyến rũ của cô dâu trong ngày trọng đại.';
                $size='35_36_37_38_39_40';
                $des='Được làm từ chất liệu satin cao cấp, chiếc giày này mang đến sự mềm mại và bóng bẩy, tạo nên một sự sang trọng không gì sánh kịp. Mũi giày được thiết kế mảnh mai và đính kèm những hạt lụa nhỏ, tạo điểm nhấn tinh tế và nữ tính.
                Những đường may tỉ mỉ và chất liệu lót êm ái giúp giảm áp lực cho chân, đồng thời giữ cho đôi chân của bạn luôn khô thoáng và thoải mái suốt cả ngày dài.';
            }else{
                $sd='Chất váy mềm mịn. Đường viền cổ tròn ôm chọn vào cơ thể, tay áo dài hẹp thun ở cổ tay áo và váy có hai lớp vải tuyn lấp lánh.';
                $size='S_M_L_XL_XXL';
                $des='Váy cưới hở vai của NA Bridal là một kiệt tác thời trang kết hợp giữa sự thanh lịch và quyến rũ. Chất liệu cao cấp và công nghệ may mắn được sử dụng để tạo ra một thiết kế vừa mới mẻ vừa tôn lên vẻ đẹp truyền thống của cô dâu. Với vai hở, chiếc váy tạo nên một dáng vẻ tinh tế, làm nổi bật đường cổ và vai, tạo điểm nhấn quyến rũ nhưng không mất đi vẻ trang nhã. Màu sắc tinh tế và đường cắt tỉ mỉ khiến cho chiếc váy trở thành một lựa chọn lý tưởng cho ngày cưới.';
            }
            Products::create([
                'Cid'=>$cat->Cid,
                'Product_name' => $cat->Categories_name . ' ' . pathinfo($file, PATHINFO_FILENAME),
                'Main_image' => $imageContent,
                'Price' => $price,
                'Sizes'=>$size,
                'Short_des'=>$sd,
                'Rent_cost'=>round(($price/7)/100000)*100000,
                'Description'=>$des,
                'Quantit_in_stock'=>rand(0,100),
            ]);
        }
        $this->info("Dữ liệu từ thư mục $directory đã được thêm vào bảng products.");
    }
    $this->info('Các dữ liệu đã được thêm vào bảng products.');
}

}
