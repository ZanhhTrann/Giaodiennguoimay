<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $primaryKey = 'Oid';

    protected $fillable = [
        'Oid',
        'Uid',
        'PMid',
        'SPid',
        'Order_name',
        'Phone_number',
        'Type',
        'id_tp',
        'id_qh',
        'id_xp',
        'street',
        'address',
        'note',
        'Total_products',
        'Total_order_price',
    ];
}
