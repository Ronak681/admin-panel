@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Edit</h2>

    <div class="border rounded p-4 shadow-sm">
        <form action="{{ route('update', $header->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" placeholder="Enter Heading" value="{{ old('heading', $header->heading) }}">
                @error('heading')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title', $header->title) }}">
                @error('title')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 pt-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter Product Description">{{ old('description', $header->description) }}</textarea>
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

                <div class="mt-2" id="imagePreviewContainer">
                    @if ($header->image)
                        <div class="position-relative">
                            <img src="{{ asset('/' . $header->image) }}" alt="Current Image" class="img-fluid" style="width: 100%; height: 100px;">
                            <button type="button" class="btn btn-light btn-sm position-absolute top-0 end-0" onclick="remove_Image('{{ $header->image }}')">&times;</button>
                            <input type="hidden" name="existing_images[]" value="{{ $header->image }}">
                        </div>
                    @endif
                </div>

                <div id="newImagePreview" class="mt-2"></div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('headerlist') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const newImagePreview = document.getElementById('newImagePreview');
        newImagePreview.innerHTML = ''; 
        const files = event.target.files;

        if (files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "New Image Preview";
                img.style.width = '200px'; 
                img.style.height = 'auto';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-light btn-sm position-absolute top-0 end-0';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = function() {
                    newImagePreview.innerHTML = '';
                    document.getElementById('image').value = ''; 
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                newImagePreview.appendChild(imgContainer);
            };

            reader.readAsDataURL(file);
        }
    });

    function remove_Image(imageName) {
        if (confirm("Are you sure you want to delete this image?")) {
            $.ajax({
                url: '{{ route("deleteImage") }}',
                type: 'DELETE',
                data: { image: imageName, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        document.getElementById('imagePreviewContainer').innerHTML = '';
                    } 
                },
            });
        }
    }
</script>
@endsection
