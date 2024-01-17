<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //get products list
    public function products(Request $request){
        //logger($request->all());
        //logger($request->status);
        if($request->status == 'desc'){
            $products = Product::where('status','0')->orderby('created_at','desc')->get();
        }else{
            $products = Product::where('status','0')->orderby('created_at','asc')->get();
        }
        return $products;

    }
}
