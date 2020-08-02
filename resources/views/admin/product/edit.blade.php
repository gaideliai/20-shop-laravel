@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <form action="{{route('product.update', [$product->id])}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="product_title" value="{{$product->title}}" class="form-control">

                            <label>Price:</label>
                            <input type="number" step="0.01" name="product_price" value="{{$product->price}}" class="form-control">

                            <label>Description: </label>
                            <textarea type="text" name="product_description" class="form-control">{{$product->description}}</textarea>
                            <hr><br>
                            <label>Category: </label>
                            <select class="form-control" name="cat[]">
                                @foreach ($cats as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->getCat->first()->catRelation->id) selected @endif>
                                    {{$category->title}}</option>
                                @endforeach
                            </select>
                            <hr><br>
                            <label>Tags: </label>
                            @foreach ($tags as $tag)
                                @php   
                                    $checked=false;
                                @endphp
                                <div class="form-check">
                                    @foreach ($product->getTag as $product_tag) 
                                        @if ($product_tag->tagRelation->id == $tag->id)                                            
                                            @php
                                                $checked = true;
                                            @endphp                                    
                                        @endif
                                    @endforeach
                                    <input type="checkbox" name="tag[]" value="{{$tag->id}}" class="form-check-input" id="{{$tag->id}}" {{$checked?'checked':''}}>
                                    <label for="{{$tag->id}}" class="form-check-label">{{$tag->title}}</label>
                                </div>
                            @endforeach
            
                            
                        </div>
                        <div id="product-photo-inputs-area">
                            <hr><br>
                            @foreach ($product->getImages as $image)
                                <img src="{{ asset('images/products/'.$image->image) }}" alt="{{$image->alt}}" style="display: block; width: 250px; height: auto;"><br><br>                                
                                <div class="form-check">
                                    <input type="checkbox" name="img[]" value="{{$image->id}}" class="form-check-input" id="{{$image->id}}">
                                    <label for="{{$image->id}}" class="form-check-label">Delete image</label>
                                </div>
                                <hr><br>
                            @endforeach                            
                            <input type="file" name="photo[]"><br>                            
                            <label>Alt:</label>                         
                            <input type="text" name="image_alt[]" value="{{ ($product->getImages->first()->alt) ?? '' }}" class="form-control">
                        </div>


                        <hr><br>
                        <button id="add-product-photo" type="button" class="btn btn-secondary">add photo</button>
                        
                        <hr><br>
                        <button type="submit" class="btn btn-secondary btn-lg">SAVE</button>
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection