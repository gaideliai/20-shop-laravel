@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New category</div>
                <div class="card-body">
                    <form action="{{route('cat.store')}}" method="post">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="cat_title" class="form-control">

                            <label>Category level:</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">0 - main</option>
                                <option value="1">1 - secondary</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-secondary btn-lg">SAVE</button>
                        @csrf
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">New tag</div>
                <div class="card-body">
                    <form action="{{route('tag.store')}}" method="post">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="tag_title" class="form-control">

                            <label>Action:</label>
                            <input type="text" name="tag_action" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-secondary btn-lg">SAVE</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection