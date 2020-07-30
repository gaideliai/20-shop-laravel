@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($products as $product)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$product->title}}</div>
                    <div class="card-body">
                        <div>{{$product->price}} Eur</div>
                        <div>{{$product->description}}</div>

                        @foreach ($product->getCat as $category)
                            <a href="{{route('cat.edit', [$category->catRelation->id])}}">{{$category->catRelation->title}}</a><br>                        
                        @endforeach
                      
                        @foreach ($product->getTag as $tag)                       
                            <a href="{{route('tag.edit', [$tag->tagRelation->id])}}">{{$tag->tagRelation->title}}</a><br>                        
                        @endforeach

                        @foreach ($product->getImages as $image)
                            <img src="{{asset('images/products/'.$image->image)}}" alt="{{$image->alt}}" style="display: block; width: 250px; height: auto;">
                        @endforeach

                        <a href="{{route('product.edit',[$product])}}" class="btn btn-dark mt-3">EDIT</a>

                        <form method="POST" action="{{route('product.destroy', [$product])}}">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-3">DELETE</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection