<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $sliderProducts = product::latest()->take(3)->get()->where('status','in-stock');
        $products = product::latest()->take(20)->get()->where('status','in-stock');
       $categories = Category::orderBy('name', 'asc')->with('children')->whereDoesntHave('parent')->get();
       
       
       return view('front.index',[
            'sliderProducts' => $sliderProducts,
            'products' => $products,
            'categories'=> $categories
        ]);
    }

    public function show($slug){
        $product = product::where('slug' , $slug)->first();
        
        return view('front.product-detail',[
            'product' => $product,
        ]);
    }
}
