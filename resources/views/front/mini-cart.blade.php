<a class="nav-link cart-button px-3 d-flex" href="">Krepšelis
    <div id="cart-count">
        <span class="count">{{$count}}</span>
        <span class="total">{{$total}}</span>
        <span class="cur">&#8364;</span>
    </div>                                                               
</a>

<div class="mini-cart-list">
    <ul>
        @foreach ($cartProducts as $item)
            <li>{{$item->title}} {{$item->price}}&#8364; x {{$cart[$item->id]['count']}} {{$cart[$item->id]['price']}}&#8364;</li>                                        
            <div class="d-flex">
                <form action="{{route('front.plus')}}" method="post">
                    <input type="hidden" name="product_id" value="{{$item->id}}">
                    <button class="mini-cart-button" type="submit">+</button>
                    @csrf
                </form>
                <form action="{{route('front.remove')}}" method="post">
                    <input type="hidden" name="product_id" value="{{$item->id}}">
                    <button class="mini-cart-button mx-1" type="submit">@include('front.trash-svg')</button>
                    @csrf
                </form>
                <form action="{{route('front.minus')}}" method="post">
                    <input type="hidden" name="product_id" value="{{$item->id}}">
                    <button class="mini-cart-button" type="submit">-</button>
                    @csrf
                </form>
            </div>                                        
        @endforeach
        <div class="sum">Užsakymo suma: {{$total}}&#8364;</div>
    </ul>                               
</div>