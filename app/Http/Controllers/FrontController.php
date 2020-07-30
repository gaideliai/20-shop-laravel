<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Services\CartService;
use App\Services\PayseraService;
use App\Cart;
use App\Order;


class FrontController extends Controller
{
    public function home(CartService $cart)
    {
        $products = Product::all();
        return view('front.home', array_merge(compact('products'), $cart->getCart()));    
    }

    public function add(CartService $cart)
    {
        $cart->addToCart();
        return redirect()->back();    
    }

    public function addJS(CartService $cart)
    {
        $cart->addToCart();
        $miniCartHTML = view('front.mini-cart', $cart->getCart())->render();
        return response()->json([
            'html' => $miniCartHTML
        ]);    
    }

    public function remove(CartService $cart)
    {
        $cart->removeFromCart();
        return redirect()->back();    
    }

    public function plus(CartService $cart)
    {
        $cart->plus();
        return redirect()->back();    
    }

    public function minus(CartService $cart)
    {
        $cart->minus();
        return redirect()->back();    
    }

    public function buy(CartService $cart, Request $request, PayseraService $paysera) {
        $buyCart = $cart->getCart();
        $order = new Order;
        $order->customer_name = $request->name;
        $order->customer_email = $request->email;
        $order->customer_phone = $request->phone;
        $order->total = $buyCart['total'];
        $order->status = 1;
        $order->save();
        $cart->empty();

        foreach($buyCart['cartProducts'] as $product) {
            $orderCart = new Cart;
            $orderCart->product_id = $product->id;
            $orderCart->order_id = $order->id;
            $orderCart->save();
        }

        return $paysera->buy($order);

    }

    public function payseraAccept(PayseraService $paysera) {
        $paysera->allGood();
        return redirect()->route('all.good');
    }

    public function allGood(CartSErvice $cart) {
        return view('front.all-good', $cart->getCart());
    }
}
