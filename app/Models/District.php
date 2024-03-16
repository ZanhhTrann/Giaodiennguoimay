<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'vn_quanhuyen';
    protected $primaryKey = 'id_qh';

    protected $fillable = [
        'id_qh',
        'name_qh',
        'type',
        'id_tp'
    ];
}
