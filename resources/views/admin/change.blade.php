<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h4 class="text-center">Change Password</h4>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                           @endif
                           @if(Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                           @endif

                                <form action="{{ route('update-password')}}"  method="POST">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" value = "{{ old('old password') }}" class="form-control @error('old password') is-Invalid @enderror" name="old password" id="old password" placeholder="old Password">
                                                <label for="old password" class="form-label">Old Password</label>
                                    
                                                @error('old password')
                                                <p class="Invalid-feedback text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" value = "{{ old('new password') }}" class="form-control @error('new password') is-Invalid @enderror" name="new password" id="new password" placeholder="new Password">
                                                <label for="new password" class="form-label">New Password</label>
                                    
                                                @error('new password')
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
                                                <button type="submit" class="btn bsb-btn-xl btn-success py-3">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
