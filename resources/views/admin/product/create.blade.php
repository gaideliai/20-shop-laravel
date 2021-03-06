@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Product</div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="product_title" class="form-control">

                            <label>Price:</label>
                            <input type="number" step="0.01" name="product_price" class="form-control">

                            <label>Description: </label>
                            <textarea type="text" name="product_description" class="form-control"></textarea>
                            <hr><br>
                            <label>Category: </label>
                            <select class="form-control" name="cat[]">
                                @foreach ($cats as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            <hr><br>
                            <label>Tags: </label>
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input type="checkbox" name="tag[]" value="{{$tag->id}}" class="form-check-input" id="{{$tag->id}}">
                                    <label for="{{$tag->id}}" class="form-check-label">{{$tag->title}}</label>
                                </div>
                            @endforeach
            
                            
                        </div>
                        <div id="product-photo-inputs-area">
                            <hr><br><input type="file" name="photo[]"><br>
                            <label>Alt:</label>
                            <input type="text" name="image_alt[]" class="form-control">
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