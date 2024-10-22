@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Category List</h2>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="border rounded p-4 shadow-sm">
        <div class="text-end mb-3">
            <a href="{{ route('add.category')}}" class="btn btn-primary">Add Category</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        {{-- <td>
                            @if($category->icon && count($category->icon) > 0)
                                <div class="d-flex flex-wrap">
                                    @foreach($category->icon as $icon)
                                        <img src="{{ asset('uploads/products/' . $icon) }}" alt="Icon" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 5px;">
                                    @endforeach
                                </div>
                                @else <div>
                                    no found
                                </div>
                            @endif
                        </td> --}}
                        
                        <td>{{ $category->title }}</td>
                 
                        <td>
                            <a href="{{ route('edit.category',$category->id)}}" class="text-primary pr-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ route('delete.category',$category->id)}}" class="text-danger delete-confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('adminn/assets/js/script.js')}}"></script>

@endsection
