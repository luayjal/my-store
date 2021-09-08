<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
   

   public function store(Request $request)
   {
      //return $request;
      
      $request->validate([
         'first_name' => 'required',
         'last_name' => 'required',
         'phone' => 'required',
         'email' => 'required',
         'address' => 'required',
         'city' => 'required',
         'country_code' => 'required',
         'postal_code' => 'required',

      ]);
      //return $request;
      $cart = Cart::with('product')->where('cart_id', App::make('cart.id'))->get();

      if ($cart->count() == 0) {
         return redirect('/');
      }

      $total = $cart->sum(function ($item) {
         return   $item->product->price * $item->quantity;
      });

      $request->merge([
         'user_id' => Auth::id(),
         'total' => $total,
      ]);

      DB::beginTransaction();
      try {
         $order = Order::create($request->all());
         foreach ($cart as $item) {
            $order->items()->create([
               'product_id' => $item->product_id,
               'quantity' => $item->quantity,
               'price' => $item->product->price,

            ]);
         }
          Cart::where('cart_id', App::make('cart.id'))->delete();
         DB::commit();
         return redirect('/')->with('status','Thank You! Your order has placed!');
      } 
      catch (Throwable $e) {
         DB::rollback();
         return redirect()->back()->with('error',$e->getMessage());
      }
   }
}
