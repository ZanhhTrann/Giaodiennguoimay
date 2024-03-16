<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_cart extends Model
{
    use HasFactory;
    protected $table = 'User_cart';

    protected $primaryKey = 'UCid';

    protected $fillable = [
        'UCid',
        'Uid',
        'Pid',
        'quantity',
        'size',
        'color'
    ];
}
