<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Services\CartService;

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
}
