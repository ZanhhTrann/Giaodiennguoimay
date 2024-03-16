<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
    use HasFactory;
    protected $table = 'Order_details';
    protected $primaryKey = 'ODid';

    protected $fillable = [
        'ODid',
        'Oid',
        'Pid',
        'color',
        'size',
        'Quantily',
        'PPatToO'
    ];
}
