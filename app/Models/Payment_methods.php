<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_methods extends Model
{
    use HasFactory;
    protected $table = 'Payment_methods';
    protected $primaryKey = 'PMid';
    protected $fillable = [
        'PMid',
        'Payment_method_name',
        'Discription'
    ];

}
