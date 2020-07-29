@extends('front.app')

@section('content')
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div id="slide1"></div>
        </div>
        <div class="swiper-slide">
            <div id="slide2"></div>
        </div>
        <div class="swiper-slide">
            <div id="slide3"></div>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
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
                    <div class="form">
                        <input type="hidden" name="route" value="{{route('front.add-js')}}">
                        <input type="hidden" name="count" value="1">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button class="add-to-cart-button" type="button">Dėti į krepšelį</button>
                        @csrf
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pirk</div>
                <div class="card-body">
                    <form action="{{route('front.buy')}}" method="POST" class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="" class="form-control">
                        <label for="">Email</label>
                        <input type="text" name="email" value="" class="form-control">
                        <label for="">Phone</label>
                        <input type="text" name="phone" value="" class="form-control">
                        <button class="add-to-cart-button" type="submit">Pirkti</button>
                        @csrf
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection