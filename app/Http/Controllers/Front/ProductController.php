<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
       $products = product::latest()->take(8)->get()->where('status','in-stock');
       $categories = Category::orderBy('name', 'asc')->get();
        return view('front.index',[
            'products' => $products,
            'categories'=> $categories
        ]);
    }
}
