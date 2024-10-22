@extends('admin.layouts.front')

@section('content')
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your  E-mail and password!</p>

              <!-- Start of the form -->
              <form action="{{route('admin.authenticate')}}" method= "post">
              @csrf
              @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
                  @endif
                @if(Session::has('error'))
                  <div class="alert alert-danger">{{Session::get('error')}}</div>
                     @endif

                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input  name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email')}}" />
                  @error('email')
                   <p class="Invalid-feedback text-danger">{{ $message }}</p>
                  @enderror
                </div>


                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="password"  name="password" class="form-control  @error('password') is-invalid @enderror " placeholder="password" value="{{ old('password')}}"  />
                  @error('password')
                   <p class="Invalid-feedback text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('admin.forgotpassword')}}">Forgot password?</a></p>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
              </form>
              <!-- End of the form -->

           

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="{{ route('admin.register')}}" class="text-white-50 fw-bold">Sign Up</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
