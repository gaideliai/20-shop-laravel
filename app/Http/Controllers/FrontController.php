<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Services\CartService;
use App\Cart;
use App\Order;
use App\Libs\WebToPay;
use App\Libs\WebToPayException;

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

    public function buy(CartService $cart, Request $request) {
        $buyCart = $cart->getCart();
        $order = new Order;
        $order->customer_name = $request->name;
        $order->customer_email = $request->email;
        $order->customer_phone = $request->phone;
        $order->total = $buyCart['total'];
        $order->status = 1;
        $order->save();

        foreach($buyCart['cartProducts'] as $product) {
            // dd($buyCart['cartProducts']);
            $orderCart = new Cart;
            $orderCart->product_id = $product->id;
            $orderCart->order_id = $order->id;
            $orderCart->save();
        }

        try {            
         
            return redirect(WebToPay::redirectToPayment(array(
                'projectid'     => 181640,
                'sign_password' => '7a454e7433a5d90aa84b5cf9988aabd4',
                'orderid'       => $order->id,
                'amount'        => (int)$order->total*100,
                'currency'      => 'EUR',
                'country'       => 'LT',
                'accepturl'     => route('paysera.accept'),
                'cancelurl'     => route('paysera.cancel'),
                'callbackurl'   => route('paysera.callback'),
                'test'          => 1,
            )));
        } catch (WebToPayException $e) {
            // handle exception
        } 

    }

    public function payseraAccept() {
        try {
            $response = WebToPay::checkResponse($_GET, array(
                'projectid'     => 0,
                'sign_password' => 'd41d8cd98f00b204e9800998ecf8427e',
            ));
     
            $orderId = $response['orderid'];
            $amount = $response['amount'];
            $currency = $response['currency'];

            $order = Order::where('id', $orderId)->first();
            if ($amount == (int) ($order->total*100) && $currency == 'EUR' && $order->status == 1) {
                $order->status = 2;
                $order->save();
            }

            //@todo: check, if order with $orderId is already approved (callback can be repeated several times)
            //@todo: check, if order amount and currency matches $amount and $currency
            //@todo: confirm order
     
            //echo 'OK';
        } catch (Exception $e) {
                echo get_class($e) . ': ' . $e->getMessage();
        }
        return redirect()->route('all.good');
    }

    public function allGood() {
        return view('front.all-good');
    }
}
