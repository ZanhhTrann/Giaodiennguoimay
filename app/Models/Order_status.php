<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    use HasFactory;
    protected $table = 'Order_status';
    protected $primaryKey = 'OSid';

    protected $fillable = [
        'OSid',
        'ODid',
        'Oid',
        'Status'
    ];
}
