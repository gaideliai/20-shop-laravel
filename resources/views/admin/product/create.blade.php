@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Product</div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    
                        <label>Title:</label>
                        <input type="text" name="product_title">

                        <div id="product-photo-inputs-area">
                            <hr><br><input type="file" name="photo[]">

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