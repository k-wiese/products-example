@extends('layouts.main')

@section('content')
    
    <div class="container">
      <div class="row">

        <div class="col-sm-10 my-3">
          <a href="{{route('product.index')}}">
            <button class="btn btn-light">Go back</button>
          </a>
        </div>
        <div class="col-sm-10 my-3">

          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
        </div>

      </div>
        <div class="row">
            <div class="col-sm-10">

            @if(session('message-product'))
              <div class="alert alert-success text-center">
                  {{ session('message-product') }}
              </div>
            @endif

      

            <form action="{{route('product.update', $product)}}" method="POST">
              @csrf
              @method('patch')
              <div class="input-group mb-3">
                
                <span class="input-group-text" id="name">Name</span>
                <input type="text" class="form-control" placeholder="{{$product->name}}" value="{{old('name')}}" aria-label="name" aria-describedby="name" name="name">
                
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="description">Description</span>
                <input type="text" class="form-control" placeholder="{{$product->description}}" value="{{old('description')}}" aria-label="description" aria-describedby="description" name="description">
              </div>

              <button type="submit" class="btn btn-outline-light d-block w-100">Update product</button>
            </form>


            <hr class="text-light my-5">
       

            @if(session('message-prices'))
            <div class="alert alert-success text-center">
                {{ session('message-prices') }}
            </div>
            @endif

            <div>
              <p class="fs-5 text-light">Add new price</p>
            </div>
            <div class="input-group mb-3" style="display:inline">
              <form action="{{route('price.store')}}" method="POST" class="form-inline">
                @csrf
                <input type="text" class="form-control" placeholder="1 EUR = 100" value="{{old('price')}}" name="price">
                <input type="hidden" name="product_id" value="{{$product->id}}">

                <button class="btn btn-outline-light mt-3" type="submit" >Add new price</button>

              </form>
            </div>

            <div class="mt-4">
              <p class="fs-5 text-light">Product's prices ({{$product->prices->count()}})</p>
            </div>

            @foreach($product->prices as $price)
            <div class="text-light">
              <p>ID: {{$price->id}}</p>
              <p>Value: {{$price->price}}</p>

            </div>
            <div class="input-group mb-3">
              <div>

                <form action="{{route('price.update', $price)}}" method="POST">
                  <input type="text" class="form-control" placeholder="{{$price->price}}" name="price">
                  @csrf
                  @method('patch')
                  <button class="btn btn-outline-light my-3" type="submit">Update</button>
                </form>
              </div>

              <div>

                <form action="{{route('price.destroy', $price)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-outline-danger" type="submit">Delete</button>
                </form>
              </div>

            </div>

            @endforeach
     
            
            </div>
        </div>
    </div>

@stop