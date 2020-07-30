<?php

namespace App\Services;

use Session;
use App\Product;


class CartService
{

    public $request;

    public function getCart() {
        $cart = Session::get('cart', []);
        $count = 0;
        $total = 0;
        $cartProducts = [];
        
        foreach ($cart as $key => $value) {
            $count += $value['count'];
            $total += $value['price'];
            $cartProducts[$key] = Product::where('id', $value['id'])->first();
        }
        
        return compact('count', 'total', 'cartProducts', 'cart');
    }

    public function addToCart() {
        $count = $this->request->count;
        $product = Product::where('id', $this->request->product_id)->first();
        $cart = Session::get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id] = 
            [
                'count'=>$cart[$product->id]['count'] + $count, 
                'id'=>$product->id, 
                'price'=>$cart[$product->id]['price'] + $product->price * $count
            ];
        } else {
            $cart[$product->id] = ['count'=>$count, 'id'=>$product->id, 'price'=>$product->price * $count];
        }
        
        Session::put('cart', $cart);
    }

    public function removeFromCart() {
        $cart = Session::get('cart', []);

        if (isset($cart[$this->request->product_id])) {
            unset($cart[$this->request->product_id]);
        }

        Session::put('cart', $cart);
    }

    public function plus() {
        $cart = Session::get('cart', []);
        $product = Product::where('id', $this->request->product_id)->first();
        $cart[$product->id] = ['count'=>$cart[$product->id]['count'] + 1, 'id'=>$product->id, 'price'=>$product->price*($cart[$product->id]['count']+1)];
        Session::put('cart', $cart);
    }

    public function minus() {
        $cart = Session::get('cart', []);
        $product = Product::where('id', $this->request->product_id)->first();
        if ($cart[$product->id]['count'] > 1) {
            $cart[$product->id] = ['count'=>$cart[$product->id]['count'] - 1, 'id'=>$product->id, 'price'=>$product->price*($cart[$product->id]['count']-1)];
        } else {
            unset($cart[$this->request->product_id]);
        }       
        
        Session::put('cart', $cart);
    }

    public function empty() {
        Session::forget('cart');
    }
}
