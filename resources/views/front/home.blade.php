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
                    <form action="{{route('front.add')}}" method="post">
                        <input type="number" name="count" value="0">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button class="add-to-cart-button" type="submit">Dėti į krepšelį</button>
                        @csrf
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection