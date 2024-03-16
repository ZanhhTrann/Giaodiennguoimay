<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'Categories';
    protected $primaryKey = 'Cid';

    protected $fillable = [
        'Cid',
        'Categories_name',
    ];
}
