@extends('admin.layouts.main')

@section('content')

<div class="container mt-5">
    <h2 class="pb-5">Add contact </h2>

    <div class="border rounded p-4 shadow-sm">
        <form action = "{{ route('contact.save')}}" method = "POST"enctype="multipart/form-data">
            @csrf
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                    <select  id="country" name="country" class="form-control bfh-countries @error('country') is-invalid @enderror bfh-countries" data-country="{{ old('country')}}" data-flags="true">
                        <option value="">Select your country</option>
                          <span class="bfh-selectbox-option input-medium" data-option="{{ old('country')}}"></span>
                        </a>
                    </select>
                    @error('country')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter phone no." value="{{ old('phone') }}">
                @error('phone')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 pt-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                @error('address')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('contact.list')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection