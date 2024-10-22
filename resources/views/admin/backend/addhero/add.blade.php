@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Add </h2>

    <div class="border rounded p-4 shadow-sm">
        <form action="{{ route('save.hero')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" placeholder="Enter Heading" value="{{ old('heading') }}">
                @error('heading')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 pt-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter Product Description">{{ old('description') }}</textarea>
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
            

            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('headerlist')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection