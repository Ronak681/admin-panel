@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h2>
    <div class="border rounded p-4 shadow-sm">
        <form action="{{ route('save.category') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
            @csrf
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <input type="hidden" name="id" value="{{ $category->id ?? '' }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter Category" value="{{ old('title', $category->title ?? '') }}">
                @error('title')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" class="form-control" id="icon" name="icon[]" multiple>
                <div id="iconPreview" class="mt-3 d-flex flex-wrap">
                    @if($icons && count($icons) > 0)
                        @foreach($icons as $icon)
                            <div class="position-relative m-1" style="width: 100px;">
                                <img src="{{ asset('uploads/banner/' . $icon->icon) }}" style="width: 100%; height: 100px;">
                                <button type="button" class="btn btn-light btn-sm position-absolute top-0 end-0" onclick="removeIcon('{{ $icon->icon }}', this)">&times;</button>
                                <input type="hidden" name="existing_icons[]" value="{{ $icon->icon }}"> 
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update Category' : 'Add Category' }}</button>
                <a href="{{ route('list.category') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('icon').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('iconPreview');
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList = 'position-relative m-1';
                imgContainer.style.width = '100px';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%'; 
                img.style.height = '100px'; 

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.classList = 'btn btn-light btn-sm position-absolute top-0 end-0';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = function() {
                    previewContainer.removeChild(imgContainer); 
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                previewContainer.appendChild(imgContainer);
            }
            reader.readAsDataURL(file);
        }  
    });

    function removeIcon(iconName, button) {
        const imgContainer = button.parentElement;
        const previewContainer = document.getElementById('iconPreview');

        $.ajax({
            url: '{{ route('remove.icon') }}',
            method: 'POST',
            data: {
                icon: iconName,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    previewContainer.removeChild(imgContainer);
                }
            },

        });
    }
</script>
@endsection
