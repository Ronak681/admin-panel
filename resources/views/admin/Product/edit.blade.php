@extends('admin.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="pb-5">Edit Product</h2>

    <div class="border rounded p-4 shadow-sm">
        <form action="{{ route('admin.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Name" value="{{ old('name', $product->name) }}">
                @error('name')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Product</label>
                <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product" placeholder="Enter Product Type" value="{{ old('product', $product->product) }}">
                @error('product')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="discount_price" class="form-label">Discount Price</label>
                <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price" placeholder="Enter Discount Price" value="{{ old('discount_price', $product->discount_price) }}">
                @error('discount_price')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="category">Select Category:</label>
                <select name="category_id[]" id="category" class="form-control @error('category_id') is-invalid @enderror js-example-basic-multiple" multiple="multiple">
                    @if(!$categories->isEmpty())
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->categories->contains('id', $category->id) ? 'selected' : '' }}>
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

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>

             <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image[]" multiple="multiple">
                <div id="imagePreview" class="mt-3 d-flex flex-wrap">
                    @if(!empty($images))
                        @foreach($images as $index => $image)
                            <div class="position-relative m-1" style="width: 100px;">
                                <img src="{{ asset('uploads/products/' . $image->image) }}" style="width: 100%; height: 100px;">
                                <button type="button" class="btn btn-light btn-sm position-absolute top-0 end-0" onclick="removeImage(this, '{{ $image->image }}')">&times;</button>
                                <input type="hidden" name="existing_images[]" value="{{ $image->image }}"> 
                            </div>
                        @endforeach
                    @endif
                </div>
                
                @error('image')
                    <p class="invalid-feedback text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('admin.product') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('imagePreview');
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
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
                removeBtn.className = 'btn btn-light btn-sm position-absolute top-0 end-0';
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

    function removeImage(button, imageName) {
        const imgContainer = button.parentElement;
        const previewContainer = document.getElementById('imagePreview');
        
        $.ajax({
            url: '{{ route("admin.image.delete") }}', 
            type: 'DELETE',
            data: { image: imageName, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    previewContainer.removeChild(imgContainer);
                } 
            }
        });
    }

   
</script>
@endsection
