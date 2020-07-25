<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontController extends Controller
{
    public function home()
    {
        $products = Product::all();
        return view('front.home', ['products' => $products]);    
    }
}
