<?php

namespace App\Console\Commands;

use App\Models\Categories;
use Illuminate\Console\Command;

class ImportCatDress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data {folderPath : "C:\Users\VivoBook\Downloads\Váy cưới"}';
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

    // Thêm tên thư mục vào cơ sở dữ liệu
    foreach ($directories as $directory) {
        Categories::create(['Categories_name' => $directory]);
        $this->info($directory.' đã được thêm vào bảng categories.');
    }
    $this->info('Các thư mục đã được thêm vào bảng categories.');

}

}
