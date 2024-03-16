<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $table = 'vn_xaphuongthitran';
    protected $primaryKey = 'id_xp';

    protected $fillable = [
        'id_xp',
        'name_xp',
        'type',//dùng để xác định categories con.
        'id_qh'
    ];
}
