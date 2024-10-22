@extends('admin.layouts.main')

@section('content')
    <div class="container d-flex justify-content-center align-items-center custom-offset">
        <div class="w-50">
            <h2 class="text-center mb-2">Change Password</h2>

            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <form action="{{ route('admin.passwordchanged') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current-password" class="form-label">Current Password</label>
                    <input type="password" id="current-password" name="current-password" class="form-control @error('current-password') is-invalid @enderror" value="{{ old('current-password') }}">
                    @error('current-password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" id="new-password" name="new-password" class="form-control @error('new-password') is-invalid @enderror" value="{{ old('new-password') }}">
                    @error('new-password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new-password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" id="new-password_confirmation" name="new-password_confirmation" class="form-control @error('new-password_confirmation') is-invalid @enderror" value="{{ old('new-password_confirmation') }}">
                    @error('new-password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

    <style>
        .custom-offset {
            height: 100vh; /* Ensure the container takes up the full height of the viewport */
            margin-top: -50px; /* Adjust this value to shift the form up */
        }
    </style>
@endsection
