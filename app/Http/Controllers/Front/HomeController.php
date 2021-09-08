<?php

namespace App\Http\Controllers\Front;
use App\Models\product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
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
}
