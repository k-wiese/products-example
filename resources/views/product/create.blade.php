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

              @livewire('product-create-form')
            
            </div>
        </div>
    </div>

@stop