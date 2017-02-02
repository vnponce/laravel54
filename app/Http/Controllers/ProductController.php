<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        if($request->sort == 'price_desc'){
            return Product::orderBy('price', 'DESC')->take(10)->get();
        }
        if($request->sort == 'price_asc'){
            return Product::orderBy('price', 'ASC')->take(10)->get();
        }
    }
}
