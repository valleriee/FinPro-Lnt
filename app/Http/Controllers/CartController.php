<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $carts = Cart::where('user_id',$user->id)->get();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request){
        $request->validate([
            'product_id'=>'required',
            'quantity'=>'required|min:1'
        ]);

        $product = Product::find($request->product_id);
        if (!$product || $request->quantity > $product->stock){
            return redirect()->route('product.index');        
        } 

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            if ($cart->product_id == $request->product_id){
                $cart->quantity += $request->quantity;
                $cart->save();
                return redirect()->route('cart.index');
            }
        }

        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index');
    }
}
