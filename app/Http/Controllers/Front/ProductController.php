<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    

    public function show($slug){
        $product = product::where('slug' , $slug)->firstOrFail();
        
        return view('front.product-detail',[
            'product' => $product,
        ]);
    }
}
