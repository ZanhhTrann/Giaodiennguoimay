<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_methods extends Model
{
    use HasFactory;
    protected $table = 'Shipping_methods';
    protected $primaryKey = 'SMid';

    protected $fillable = [
        'SMid',
        'Shipping_methods_name',
        'price',
        'Discription'
    ];
}
