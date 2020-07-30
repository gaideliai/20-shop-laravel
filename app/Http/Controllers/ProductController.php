<?php

namespace App\Http\Controllers;

use App\Product;
use App\Image;
use App\Cat;
use App\Tag;
use App\Product_tag;
use App\Product_cat;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Cat::all();
        $tags = Tag::all();
        return view('admin.product.create', compact('cats', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->title = $request->product_title;
        $product->price = $request->product_price;
        $product->description = $request->product_description;
        $product->save();
        
        foreach ($request->file('photo') as $key => $uploaded_image) {
            $name = $uploaded_image->getClientOriginalName();
            $destinationPath = public_path('/images/products');
            $uploaded_image->move($destinationPath, $name);

            $image = new Image;
            $image->image = $name;
            $image->alt = $request->image_alt[$key];
            $image->no = $key;
            $image->product_id = $product->id;
            $image->save();            
        }

        $categories = Cat::where('id', $request->cat)->get();
        foreach ($categories as $category){
            $productCat = new Product_cat;
            $productCat->product_id = $product->id;
            $productCat->cat_id = $category->id;
            $productCat->save();
        }

        $tags = Tag::where('id', $request->tag)->get();
        // dd($tags);
        foreach ($tags as $tag){
            $productTag = new Product_tag;
            $productTag->product_id = $product->id;
            $productTag->tag_id = $tag->id;
            $productTag->save();
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $cats = Cat::all();
        $tags = Tag::all();
        return view('admin.product.edit', compact('product', 'cats', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->product_title;
        $product->price = $request->product_price;
        $product->description = $request->product_description;
        $product->save();
        
        foreach ($request->file('photo') as $key => $uploaded_image) {
            $name = $uploaded_image->getClientOriginalName();
            $destinationPath = public_path('/images/products');
            $uploaded_image->move($destinationPath, $name);

            $image = $product->getImages();
            $image->image = $name;
            $image->alt = $request->image_alt[$key];
            $image->no = $key;
            $image->product_id = $product->id;
            $image->save();            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->getImages as $photo) {
            $photo->delete();
        }
        foreach ($product->getCat as $cat) {
            $cat->delete();
        }
        foreach ($product->getTag as $tag) {
            $tag->delete();
        }
        $product->delete();     
      
        return redirect()->route('product.index');
    }
}
