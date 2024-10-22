@extends('admin.layouts.main')

@section('content')

<style>
    .post-title {
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        padding: 20px;
        color: #343a40;
    }
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .form-group label {
        font-weight: 600;
        margin-bottom: 10px;
    }
    .btn-custom {
        color: white;
        font-weight: 600;
        width: 100%;
    }
</style>

<div class="container mt-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
    @endif
    <h1 class="post-title">Add Post</h1>
    <div class="form-container">
        <form action="{{ route('blog.add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="name" value="{{old('name')}}" >
                @error('name')
                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter post title" value="{{old('title')}}" >
                @error('title')
                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="date">Date</label>
                <input type="text" id="date" readonly="readonly" name="date" class="form-control datepicker @error('date') is-invalid @enderror" placeholder="Enter date" value="{{ old('date') }}">
                @error('date')
                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" placeholder="Write your content here">{{old('content')}}</textarea>
                @error('content')
                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="image">Add Image</label>
                <input type="file" name="image" class="form-control-file">
                @error('image')
                    <p class="Invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            
                <button type="submit" class="btn btn-primary">Create Post</button>
                 <a href="{{ route('blog.list')}}" class="btn btn-danger"> Cancel</a>
        </form>
    </div>
</div>

@endsection
