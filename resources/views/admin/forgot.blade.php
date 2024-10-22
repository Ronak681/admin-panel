@extends('admin.layouts.reset')
@section('content')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h4 class="text-center">Reset Password Here</h4>
                                        </div>
                                    </div>
                                </div>
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.reset')}}" method="POST">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                            <p>forgot your password? No problem, just let us know your email address and we will email you a password reset link that will allow you to choose a new one</p>
                                           </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" id="email_address" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-Mail Address">
                                                <label for="email_address" class="form-label">E-Mail Address</label>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn bsb-btn-xl btn-primary py-3">Send Password Reset Link</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     @endsection
