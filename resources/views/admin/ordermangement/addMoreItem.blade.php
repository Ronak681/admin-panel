
<div id="item-container" class="item-count">

    <div class="item-row border p-3 mb-3" data-row="{{ $counter }}">
        <div class="border p-4 mb-4">
            <h4 class="mb-3 text-center pb-3 pt-3">Item Details {{ $counter}}</h4>
        </div>
            <div class="text-end mb-2 pb-4">
            <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="style_name_{{ $counter }}" class="form-label">Style Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('style_name') is-invalid @enderror valid" id="style_name_{{ $counter }}" name="item_data[{{ $counter }}][style_name]" placeholder="Style name" >
                <div class="invalid-feedback">{{ $errors->first('style_name') }}</div>
            </div>
            <div class="col-md-3">
                <label for="item_name_{{ $counter }}" class="form-label">Item Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('item_name') is-invalid @enderror valid" id="item_name_{{ $counter }}" name="item_data[{{ $counter }}][item_name]" placeholder="Item name" >
                <div class="invalid-feedback">{{ $errors->first('item_name') }}</div>
            </div>
            <div class="col-md-3">
                <label for="hsn_code_{{ $counter }}" class="form-label">HSN Code <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('hsn_code') is-invalid @enderror valid" id="hsn_code_{{ $counter }}" name="item_data[{{ $counter }}][hsn_code]" placeholder="HSN Code" >
                <div class="invalid-feedback">{{ $errors->first('hsn_code') }}</div>
            </div>
            <div class="col-md-3">
                <label for="color_name_{{ $counter }}" class="form-label">Color Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('color_name') is-invalid @enderror valid" id="color_name_{{ $counter }}" name="item_data[{{ $counter }}][color_name]" placeholder="Color name" >
                <div class="invalid-feedback">{{ $errors->first('color_name') }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="size_name_{{ $counter }}" class="form-label">Size Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('size_name') is-invalid @enderror valid" id="size_name_{{ $counter }}" name="item_data[{{ $counter }}][size_name]" placeholder="Size name" >
                <div class="invalid-feedback">{{ $errors->first('size_name') }}</div>
            </div>
            <div class="col-md-3">
                <label for="rate_{{ $counter }}" class="form-label">Rate <span class="text-danger">*</span></label>
                <input  type="number" class="form-control @error('rate') is-invalid @enderror valid" id="rate_{{ $counter }}" name="item_data[{{ $counter }}][rate]" placeholder="Rate" >
                <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
            </div>
            <div class="col-md-3">
                <label for="unit_name_{{ $counter }}" class="form-label">Unit Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('unit_name') is-invalid @enderror valid" id="unit_name_{{ $counter }}" name="item_data[{{ $counter }}][unit_name]" placeholder="Unit name" >
                <div class="invalid-feedback">{{ $errors->first('unit_name') }}</div>
            </div>
            <div class="col-md-3">
                <label for="quantity_{{ $counter }}" class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror valid" id="quantity_{{ $counter }}" name="item_data[{{ $counter }}][quantity]" placeholder="Quantity" >
                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
            </div>
        </div>
    </div>
</div>
