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
                    @foreach ($product->getImages as $image)
                <img src="{{asset('images/products/'.$image->image)}}" alt="{{$image->alt}}" style="width: 250px; height: auto;">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection