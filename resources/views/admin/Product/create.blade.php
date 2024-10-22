@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Add Product</h2>

    <div class="border rounded p-4 shadow-sm">
        <form action="/admin/product" method="post" enctype="multipart/form-data">
            @csrf
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Name" value="{{ old('name') }}">
                @error('name')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Product</label>
                <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product" placeholder="Enter Product Type" value="{{ old('product') }}">
                @error('product')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}">
                @error('price')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="discount_price" class="form-label">Discount Price</label>
                <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price" placeholder="Enter discount Price" value="{{ old('discount_price') }}">
                @error('discount_price')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="form-label">Select Categories:</label>
                <select name="category_id[]" id="category" class="js-example-basic-multiple form-control @error('category_id') is-invalid @enderror" multiple="multiple">
                    @if(!$categories->isEmpty())
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, old('category_id', [])) ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach   
                    @else
                     <option value="">No categories available</option>
                    @endif
                </select>
                @error('category_id')
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
                <input type="file" class="form-control" id="image" name="image[]" multiple="multiple">
                <div id="imagePreview" class="mt-3 d-flex flex-wrap width-80px">

                </div>
                @error('image')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            

            <div>
                <button type="submit" class="btn btn-primary">Add Product</button>
                <a href="{{ route('admin.product')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>



@endsection
@section('js')
<script>
    let selectedFiles = [];

    document.getElementById('image').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('imagePreview');
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            selectedFiles.push(file);
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative m-1';
                imgContainer.style.width = '100px';
                

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%'; 
                img.style.height = '100px'; 
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.classList = 'btn btn-light btn-sm position-absolute top-0 end-0';
                removeBtn.innerHTML = '&times;';
                removeBtn.setAttribute('data-filename', file.name);

                removeBtn.onclick = function() {
                    const index = selectedFiles.findIndex(d => d.name === file.name);
                    if (selectedFiles.includes(file)) {
                        selectedFiles.splice(index, 1); 
                    }
                    previewContainer.removeChild(imgContainer);
                    removeImage(file.name);

                    updateFileInput();
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                previewContainer.appendChild(imgContainer);
            }

            reader.readAsDataURL(file);
        }
    });

    function removeImage(filename) {
        $.ajax({
            url: '{{ route("admin.image.delete") }}',
            type: 'DELETE',
            data: { image: filename, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                } else {
                    console.error("Error:", response.error);
                }
            },
        });
    }

    function updateFileInput() {
        const fileInput = document.getElementById('image');
        const newDataTransfer = new DataTransfer(); 
        for (const file of selectedFiles) {
            newDataTransfer.items.add(file);
        }
        fileInput.files = newDataTransfer.files;
    }
</script>
@endsection