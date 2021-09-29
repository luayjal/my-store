<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;
use Illuminate\Support\Facades\App;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      
        $cart = Cart::with('product')->where('cart_id' ,App::make('cart.id'))->get();

        $total = $cart->sum(function($item){
         return   $item->product->price * $item->quantity;
        });
        
        return view('layouts.front',[
            'cart'=>$cart,
            'total'=>$total
        ]);
    }
}
