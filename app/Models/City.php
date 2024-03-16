<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'vn_tinhthanhpho';
    protected $primaryKey = 'id_tp';

    protected $fillable = [
        'name_tp',
        'name_tp',
        'type',//dùng để xác định categories con.
        'slug'
    ];
}
