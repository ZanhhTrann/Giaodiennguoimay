<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __getCategories() {
        if(!session()->has('categories')){
            session(['categories'=>Categories::select('Cid','Categories_name')->orderBy('Cid', 'desc')->get()]);
        }
    }
    public function __getCatByCid($cid){
        return Categories::select('Cid','Categories_name')->where('Cid',$cid)->first();
    }

}
