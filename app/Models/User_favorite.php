<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_favorite extends Model
{
    use HasFactory;
    protected $table = 'User_favorite';
    protected $primaryKey = 'UFid';

    protected $fillable = [
        'UFid',
        'Uid',
        'Pid'
    ];
}
