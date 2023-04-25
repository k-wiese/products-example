@extends('layouts.main')

@section('content')
    
<div class="container text-light">

    <div class="row">
        
        @foreach($products as $product)
        <div class="col-sm-3 my-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('img/placeholder.jpg')}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$product->name}}</h5>
                  <p class="card-text">{{$product->description}}</p>
                  <a href="#" class="btn btn-primary">Buy</a>
                </div>
              </div>
        </div>
        @endforeach
        <div class="mt-3">
            {{$products->links()}}
        </div>

    </div>

</div>

@stop