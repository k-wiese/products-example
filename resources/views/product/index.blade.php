@extends('layouts.main')

@section('content')
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-10 text-light">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <hr class="mb-5 text-light">
          <form action="{{route('product.index')}}" method="GET" class="form-inline">
          <div class="row justify-content-center">

            <div class="col-3">
              <p>Sort by</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="sortBy" id="sortBy1" @if(isset($_GET['sortBy']) and $_GET['sortBy'] ==='name')checked @endif  value="name">
                <label class="form-check-label" for="sortBy1">
                  Name
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="sortBy" id="sortBy2" @if(isset($_GET['sortBy']) and $_GET['sortBy'] ==='id')checked @endif @if(!isset($_GET['sortBy']))checked @endif value="id">
                <label class="form-check-label" for="sortBy2">
                  ID
                </label>
              </div>
            </div>
            <div class="col-3">
              <p>Ascending or Descending</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="ascOrDesc" id="ascOrDesc1" @if(isset($_GET['ascOrDesc']) and $_GET['ascOrDesc'] ==='asc')checked @endif @if(!isset($_GET['ascOrDesc']))checked @endif value="asc">
                <label class="form-check-label" for="ascOrDesc1">
                  Ascending
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="ascOrDesc" id="ascOrDesc2" @if(isset($_GET['ascOrDesc']) and $_GET['ascOrDesc'] ==='desc')checked @endif  value="desc">
                <label class="form-check-label" for="ascOrDesc2">
                  Descending
                </label>
              </div>
            </div>
            <div class="col-3">
   
              <p>Filter by</p>
              <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="hasPrice" @if(isset($_GET['hasPrice']) and $_GET['hasPrice'] !== false) checked @endif name="hasPrice" value="true">
              <label class="form-check-label" for="hasPrice">Has price</label>
            </div>
            </div>

            <div class="col-3">
              <p>Per page</p>
              <div class="input-group mb-3">
                <input type="number" class="form-control" @isset($_GET['qty']) value="{{$_GET['qty']}}"@else value="15" @endisset name="qty">
              </div>
            </div>

            <div class="mt-3 mb-5 col-12">
              <button class="btn btn-outline-light d-block w-100">Apply</button>
              
            </div>
          </div>
        </form>
      
 
    
        <hr class="mb-4 text-light">
        </div>
      </div>

        <div class="row justify-content-center">
            <div class="col-sm-10">

              <div class="my-3">
                <a href="{{route('product.create')}}">
                <button class="btn btn-light">Add new product</button>
              </a>
              </div>

              @if(session('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
              @endif

                <table class="table table-dark table-striped align-middle">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prices</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)
                      <tr>
                        <th scope="row justify-content-center">{{$product->id}}</th>
                        <td>
                          <a href="{{route('product.show', $product)}}">
                            {{$product->name}}
                          </a>
                        </td>
                        <td class="text-break"> <small>{{$product->description}}</small></td>
                        <td>
                            @foreach($product->prices as $price)
                            
                            <b>{{$price->price}}</b> EUR

                            @endforeach
                        </td>
                        <td>
                          <a href="{{route('product.edit', $product)}}">
                            <button class="btn btn-light btn-sm">Edit</button>
                          </a>
                        </td>
                        <td>
                          <form action="{{route('product.destroy', $product)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="mt-3">
                    {{$products->links()}}
                  </div>
            </div>
        </div>
    </div>

@stop