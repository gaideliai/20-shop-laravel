<?php

namespace App\Services;

use Session;
use App\Product;
use App\Order;
use App\Libs\WebToPay;
use App\Libs\WebToPayException;


class PayseraService
{

    private $config; 

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function buy(Order $order) 
    {
        try {            
            
            return redirect(WebToPay::redirectToPayment([
                'projectid'     => $this->config['projectid'],
                'sign_password' => $this->config['sign_password'],
                'orderid'       => $order->id,
                'amount'        => (int)$order->total*100,
                'currency'      => 'EUR',
                'country'       => 'LT',
                'accepturl'     => route('paysera.accept'),
                'cancelurl'     => route('paysera.cancel'),
                'callbackurl'   => route('paysera.callback'),
                'test'          => 1,
            ]));
        } catch (WebToPayException $e) {
            // handle exception
        }
    }

    public function allGood() 
    {
        try {
            $response = WebToPay::checkResponse($_GET, $this->config);     
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
        } catch (\Exception $e) {
            echo get_class($e) . ': ' . $e->getMessage();
        }
    }
}