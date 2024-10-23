@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">{{ isset($about) ? 'Edit About Us' : 'Add About Us' }}</h2>

    <div class="border rounded p-4 shadow-sm">
        <form action="{{ isset($about) ? route('about.update', $about->id) : route('about.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($about))
                @method('PUT')
            @endif
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" placeholder="Enter Heading" value="{{ old('heading', isset($about) ? $about->heading : '') }}">
                @error('heading')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 pt-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter Product Description">{{ old('description', isset($about) ? $about->description : '') }}</textarea>
                @error('description')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            @if(isset($about) && $about->image)
                <div class="mb-3">
                    <label for="current_image" class="form-label">Current Image</label>
                    <img src="{{ asset('storage/' . $about->image) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;">
                </div>
            @endif

            <div>
                <button type="submit" class="btn btn-primary">{{ isset($about) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('about.list') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
