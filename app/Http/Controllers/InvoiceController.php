<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class InvoiceController extends Controller
{
    //
    public function index(){
        $invoices=Invoice::where('user_id', Auth::user()->id)->get();
        // dd($invoices);
        return view('invoice.index', compact('invoices'));
    }
    
    public function create(){
        $carts=Cart::where('user_id', Auth::user()->id)->get();
        return view('invoice.create', compact('carts'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'address'=>'required|string|min:10|max:100',
            'postal_code'=>'required|integer|digits:5',
            'total_price'=>'required'
        ]);

        $invoiceNumber = Invoice::generateInvoiceNumber();

        $invoice = Invoice::create([
            'user_id'=> Auth::user()->id,
            'invoice_num'=> $invoiceNumber,
            'name'=> $request->name,
            'address'=> $request->address,
            'postal_code'=> $request->postal_code,
            'total_price'=> $request->total_price,
        ]);

        //hilangin isi cart
        $carts=Cart::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $order = Order::create([
                'user_id'=>$cart->user_id,
                'product_id'=>$cart->product_id,
                'invoice_id'=>$invoice->id,
                'quantity'=>$cart->quantity,
            ]);

            $product = Product::find($cart->product_id);
            if ($product) {
                $product->stock -= $cart->quantity;
                $product->save();
            }

            $cart->delete();
        }

        return redirect()->route('invoice.index');
    }

    public function show($invoice_num){
        // dd($invoice_num);
        $invoice=Invoice::where('invoice_num', $invoice_num)->first();
        // dd($invoice);

        if(is_null($invoice)){
            return view('invoice.index');
        }

        return view('invoice.show', compact('invoice'));
    }
}
