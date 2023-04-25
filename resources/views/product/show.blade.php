@extends('layouts.main')

@section('content')
    
    <div class="container">
      <div class="row">

        <div class="col-sm-10 my-3">
          <a href="{{route('product.index')}}">
            <button class="btn btn-light">Go back</button>
          </a>
        </div>

      </div>
        <div class="row">
            <div class="col-sm-10">

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

                      <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>
                          <a href="{{route('product.show', $product)}}">
                            {{$product->name}}
                          </a>
                        </td>
                        <td class="text-break"> <small>{{$product->description}}</small></td>
                        <td>
                            @foreach($product->prices as $price)
                            {{$price->price.' '}}
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

                    </tbody>
                  </table>

            </div>
        </div>
    </div>

@stop