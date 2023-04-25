<div class="container my-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Products Example App</a>
              </li>

              @if(!Auth::check())

                <li class="nav-item">
                  <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>

              @else

                <li class="nav-item">
                  <a class="nav-link" href="{{route('product.index')}}">Manage Products</a>
                </li>

                <li class="nav-item">

                  <form action="{{route('logout')}}" method="POST">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-outline-danger btn-sm mt-1 mx-2"> Log Out</button>
                  </form>
                </li>

              @endif

            </ul>
          </div>
        </div>
      </nav>
</div>
