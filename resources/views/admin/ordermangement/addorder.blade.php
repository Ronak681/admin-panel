@extends('admin.layouts.main')

@section('content') 

<form id="orderForm" action="{{route('save.order')}}" method="POST" class="mx-3"> 
    @csrf 

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="border p-4 mb-4"> 
        <h2 class="mb-4 pt-4 pb-3">{{ isset($purchase) ? 'Edit Order' : 'Add New Order' }}</h2> 
        <div class="text-end mb-3"> 
          <a href="{{ route('purchase.list') }}" class="btn btn-danger">Back to list</a>
        </div>
        <input type="hidden" name="id" value="{{!empty($purchase->id)?$purchase->id:''}}">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('company_name') is-invalid @enderror valid" id="company_name" name="company_name" placeholder="Company name" value="{{ old('company_name', $purchase->company_name ?? '') }}">
                <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>

            </div>
            <div class="col-md-4">
                <label for="supplier_name" class="form-label">Supplier Name <span class="text-danger">*</span></label>
                <select class="form-control @error('supplier_name') is-invalid @enderror valid" id="supplier_name" name="supplier_name">
                    <option value=""selected>Select Supplier</option>
                    @if (!$suppliers->isEmpty())
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ old('supplier_name', optional($purchase)->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>No suppliers found</option>
                    @endif
                </select>
                <div class="invalid-feedback">{{ $errors->first('supplier_name') }}</div>
            </div>
            <div class="col-md-4">
                <label for="serial_number" class="form-label">Serial Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('serial_number') is-invalid @enderror valid" id="serial_number" name="serial_number" placeholder="Serial Number" value="{{ old('serial_number', $purchase->serial_number ?? '') }}">
                <div class="invalid-feedback">{{ $errors->first('serial_number') }}</div>
            </div>
       </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="delivery_date" class="form-label">Delivery Date <span class="text-danger">*</span></label>
                <input type="text" id="delivery_date" readonly="readonly" class="form-control datepicker @error('delivery_date') is-invalid @enderror valid" name="delivery_date" value="{{ old('delivery_date', $purchase->delivery_date ?? '') }}" placeholder="Select delivery date">
                <div class="invalid-feedback">{{ $errors->first('delivery_date') }}</div>
            </div>
            <div class="col-md-4">
                <label for="create_date" class="form-label">Create Date <span class="text-danger">*</span></label>
                <input type="text" id="create_date" readonly="readonly" class="form-control datepicker @error('create_date') is-invalid @enderror valid" name="create_date" value="{{ old('create_date', $purchase->create_date ?? '') }}" placeholder="Select create date">
                <div class="invalid-feedback">{{ $errors->first('create_date') }}</div>
            </div>
        </div>
   </div> 

    <div class="border p-4 mb-4">
        <h4 class="mb-3 text-center pb-3 pt-3">Item Details</h4>
        <div class="text-end mb-2 pb-4">
            <button type="button" class="btn btn-primary" id="add-more">Add More</button>
            <div id="loader" style="display: none; text-align: center;">
                <img src="{{asset('adminn/assets/images/Iphone-spinner-2.gif')}}" alt="Loading..." />
            </div>
        </div>

     <div id="item-container" class="item-count">
            @if(isset($purchase->items))
                @foreach($purchase->items as $index => $item)
                <div class="item-row border p-3 mb-3" data-row="{{ $index }}" data-item-id="{{ $item->id }}">
                    <input type="hidden"  name="item_data[{{ $index }}][item_tbl_id]" value="{{ !empty($item->id) ? $item->id : '' }}">
                        <div class="text-end mb-2 pb-4">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="style_name_{{ $index }}" class="form-label">Style Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('style_name') is-invalid @enderror valid" id="style_name_{{ $index }}" name="item_data[{{ $index }}][style_name]" placeholder="Style name" value="{{ old('item_data.'.$index.'.style_name', $item->style_name ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('style_name') }}</div>    
                            </div>
                            <div class="col-md-3">
                                <label for="item_name_{{ $index }}" class="form-label">Item Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('item_name') is-invalid @enderror valid" id="item_name_{{ $index }}" name="item_data[{{ $index }}][item_name]" placeholder="Item name" value="{{ old('item_data.'.$index.'.item_name', $item->item_name ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('item_name') }}</div> 
                            </div>
                            <div class="col-md-3">
                                <label for="hsn_code_{{ $index }}" class="form-label">HSN Code <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('hsn_code') is-invalid @enderror valid" id="hsn_code_{{ $index }}" name="item_data[{{ $index }}][hsn_code]" placeholder="HSN Code" value="{{ old('item_data.'.$index.'.hsn_code', $item->hsn_code ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('hsn_code') }}</div>
                            </div>
                            <div class="col-md-3">
                                <label for="color_name_{{ $index }}" class="form-label">Color Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('color_name') is-invalid @enderror valid" id="color_name_{{ $index }}" name="item_data[{{ $index }}][color_name]" placeholder="Color name" value="{{ old('item_data.'.$index.'.color_name', $item->color_name ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('color_name') }}</div> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="size_name_{{ $index }}" class="form-label">Size Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('size_name') is-invalid @enderror valid" id="size_name_{{ $index }}" name="item_data[{{ $index }}][size_name]" placeholder="Size name" value="{{ old('item_data.'.$index.'.size_name', $item->size_name ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('size_name') }}</div> 
                            </div>
                            <div class="col-md-3">
                                <label for="rate_{{ $index }}" class="form-label">Rate <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('rate') is-invalid @enderror valid" id="rate_{{ $index }}" name="item_data[{{ $index }}][rate]" placeholder="Rate" value="{{ old('item_data.'.$index.'.rate', $item->rate ?? '0.00') }}">
                                <div class="invalid-feedback">{{ $errors->first('rate') }}</div> 
                            </div>
                            <div class="col-md-3">
                                <label for="unit_name_{{ $index }}" class="form-label">Unit Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('unit_name') is-invalid @enderror valid" id="unit_name_{{ $index }}" name="item_data[{{ $index }}][unit_name]" placeholder="Unit name" value="{{ old('item_data.'.$index.'.unit_name', $item->unit_name ?? '') }}">
                                <div class="invalid-feedback">{{ $errors->first('unit_name') }}</div>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity_{{ $index }}" class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror valid" id="quantity_{{ $index }}" name="item_data[{{ $index }}][quantity]" placeholder="Quantity" value="{{ old('item_data.'.$index.'.quantity', $item->quantity ?? '1') }}">
                                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
           <div class="item-row border p-3 mb-3" data-row="0">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="style_name_0" class="form-label">Style Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('style_name') is-invalid @enderror valid" id="style_name_0" name="item_data[0][style_name]" placeholder="Style name" value="{{ old('item_data.0.style_name') }}">
                        <div class="invalid-feedback">{{ $errors->first('style_name') }}</div> 
                    </div>
                    <div class="col-md-3">
                        <label for="item_name_0" class="form-label">Item Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('item_name') is-invalid @enderror valid" id="item_name_0" name="item_data[0][item_name]" placeholder="Item name" value="{{ old('item_data.0.item_name') }}">
                        <div class="invalid-feedback">{{ $errors->first('item_name') }}</div>
                    </div>
                    <div class="col-md-3">
                        <label for="hsn_code_0" class="form-label">HSN Code <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('hsn_code') is-invalid @enderror valid" id="hsn_code_0" name="item_data[0][hsn_code]" placeholder="HSN Code" value="{{ old('item_data.0.hsn_code') }}">
                        <div class="invalid-feedback">{{ $errors->first('hsn_code') }}</div>
                    </div>
                    <div class="col-md-3">
                        <label for="color_name_0" class="form-label">Color Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('color_name') is-invalid @enderror valid" id="color_name_0" name="item_data[0][color_name]" placeholder="Color name" value="{{ old('item_data.0.color_name') }}">
                        <div class="invalid-feedback">{{ $errors->first('color_name') }}</div> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="size_name_0" class="form-label">Size Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('size_name') is-invalid @enderror valid" id="size_name_0" name="item_data[0][size_name]" placeholder="Size name" value="{{ old('item_data.0.size_name') }}">
                        <div class="invalid-feedback">{{ $errors->first('size_name') }}</div> 
                    </div>
                    <div class="col-md-3">
                        <label for="rate_0" class="form-label">Rate <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('rate') is-invalid @enderror valid" id="rate_0" name="item_data[0][rate]" placeholder="Rate" value="{{ old('item_data.0.rate') }}">
                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div> 
                    </div>
                    <div class="col-md-3">
                        <label for="unit_name_0" class="form-label">Unit Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('unit_name') is-invalid @enderror valid" id="unit_name_0" name="item_data[0][unit_name]" placeholder="Unit name" value="{{ old('item_data.0.unit_name') }}">
                        <div class="invalid-feedback">{{ $errors->first('unit_name') }}</div> 
                    </div>
                    <div class="col-md-3">
                        <label for="quantity_0" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror valid" id="quantity_0" name="item_data[0][quantity]" placeholder="Quantity" value="{{ old('item_data.0.quantity') }}">
                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div> 
                    </div>
                </div>
           </div>
         @endif
        </div>
        <div class="row md-3 ml-1 mr-1">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Remarks">{{ old('remarks',$purchase->remarks ?? '' ) }}</textarea>
           
        </div>
    </div>

    <div class="text-left">
        <button type="submit" class="btn btn-success">{{ isset($purchase) ? 'Update Order' : 'Create Order' }}</button>
    </div>
</form>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



<script>
    $(document).ready(function() {
        let counter = $('.item-row').length; 
        let csrfToken = $('meta[name="csrf-token"]').attr('content'); 
    
        $('#add-more').click(function(e) {
            e.preventDefault();
            $('#loader').show();
    
            $('.error-message').remove();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
    
            $.ajax({
                url: "{{ route('ajax.addmore') }}", 
                type: 'POST',
                data: {
                    'counter': counter,
                    '_token': csrfToken 
                },
                success: function(data) {
                    $('#item-container').append(data); 
                    counter++;
                },
                complete: function() {
                    $('#loader').hide();
                } 
            });
        });
    
        $('#orderForm').on('submit', function(e) {
            e.preventDefault();
            $('.error-message').remove();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
    
            let isValid = true;
            $('.valid').each(function() {
                if ($(this).val() === '') {
                    isValid = false; 
                    $(this).after('<span class="error-message" style="color: red;">This field is required.</span>');
                }
            });
    
            if (!isValid) {
                return;
            }
    
            $.ajax({
                url: "{{ route('save.order') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        localStorage.setItem('successMessage', response.message);
                        window.location.href = "{{ route('purchase.list') }}"; 
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        let errors = xhr.responseJSON.errors;
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').text('');
                        $.each(errors, function(key, value) {   
                            if (key.startsWith('item_data.')) {
                                let itemIndex = key.split('.')[1];
                                let fieldName = key.split('.')[2]; 
                                $('#' + fieldName + '_' + itemIndex).addClass('is-invalid');
                                $('#' + fieldName + '_' + itemIndex).siblings('.invalid-feedback').text(value[0]);
                            } else {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).siblings('.invalid-feedback').text(value[0]);
                            }
                        }); 
                    }
                }
            });
        });
    
        $('#item-container').on('click', '.remove-row', function() {
            const row = $(this).closest('.item-row');
            const itemId = row.data('item-id');

            swal({
                title: "Are you sure?",
                text: "You want to remove this item!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Yes",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    },
                    cancel: {
                        text: "No",
                        value: null,
                        visible: true,
                        className: "btn btn-danger"
                    }
                }
            }).then((willRemove) => {
                if (willRemove) {
                    $.ajax({
                        url: "{{ route('order.item.remove', '') }}/" + itemId,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')      
                        },
                        success: function(response) {
                            row.remove();
                            $('.error-message').remove();
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').text('');
                        },
                    });
                }
            });
        });

    
        $('#delivery_date').datepicker({
            dateFormat: 'yy/mm/dd'  
        });
    
        $('#create_date').datepicker({
            dateFormat: 'yy/mm/dd' 
        });
    });
</script>
@endsection
