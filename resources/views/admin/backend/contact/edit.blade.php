@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Edit contact </h2>

    <div class="border rounded p-4 shadow-sm">
        <form action ="{{ route('contact.update',$contact->id)}}" method ="POST"enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select id="country" name="country" class="form-control bfh-countries @error('country') is-invalid @enderror" data-country="{{ old('country', $contact->country) }}" data-flags="true">
                    <input type="hidden" value="">
                    <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
                        <span class="bfh-selectbox-option input-medium" data-option="{{ old('country', $contact->country) }}"></span>
                        <b class="caret"></b>
                    </a>
                </select>
                @error('country')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter phone no." value="{{ old('phone',$contact->phone) }}">
                @error('phone')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 pt-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter address">{{ old('address',$contact->address) }}</textarea>
                @error('address')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('contact.list')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection