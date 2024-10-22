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
                                            <h4 class="text-center">Reset Password</h4>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::has('success'))
                                             <div class="alert alert-success">{{Session::get('success')}}</div>
                                        @endif
                                        @if(Session::has('error'))
                                             <div class="alert alert-danger">{{Session::get('error')}}</div>
                                        @endif
                                <form action="{{ route('reset.password.post')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="row gy-3 overflow-hidden">
                                       
                                        <div class="col-12">
                                
                                                <div class="form-floating mb-3">
                                                    <input type="password" value = "{{ old('password') }}" class="form-control @error('password') is-Invalid @enderror" name="password" id="password" value="" placeholder="Password">
                                                    <label for="password" class="form-label">Password</label>
                                                
                                                    @error('password')
                                                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
                                                <label for="password-confirm" class="form-label">Confirm Password</label>

                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary py-3">Reset Password</button>
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