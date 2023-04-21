@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                Sorting row
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('img/placeholder.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Name</h5>
                      <p class="card-text">Description of description of description in description</p>
                      <a href="#" class="btn btn-primary">Check it out!</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@stop