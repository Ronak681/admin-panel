@extends('admin.layouts.main')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 pt-4 pb-3">{{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}</h2> 
        <div class="border rounded p-4 shadow-sm">
            <form id="supplierForm" action="{{ route('save.supplier')}}" method="POST" >
                @csrf
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <input type="hidden" name="id" value="{{!empty($supplier->id)?$supplier->id:''}}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="supplier_name" class="form-label">Supplier Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('supplier_name') is-invalid @enderror" id="supplier_name" name="supplier_name" placeholder="Supplier Name" value="{{ old('supplier_name',$supplier->supplier_name ?? '') }}">
                        <div class="invalid-feedback">{{ $errors->first('supplier_name') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input class="form-control valid @error('email') is-invalid @enderror" id="email" name="email" placeholder="E-mail" value="{{ old('email',$supplier->email ?? '') }}">
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control valid @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number',$supplier->phone_number ?? '') }}" placeholder="Phone Number">
                        <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country',$supplier->country ?? '') }}" placeholder="Country Name">
                        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state',$supplier->state ?? '') }}" placeholder="State Name">
                        <div class="invalid-feedback">{{ $errors->first('state') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city',$supplier->city ?? '') }}" placeholder="City Name">
                        <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pin_code" class="form-label">Pincode <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control valid @error('pincode') is-invalid @enderror" id="pin_code" name="pin_code" value="{{ old('pin_code',$supplier->pin_code ?? '') }}" placeholder="Pincode">
                        <div class="invalid-feedback">{{ $errors->first('pin_code') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="gst_number" class="form-label">GST Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('gst_number') is-invalid @enderror" id="gst_number" name="gst_number" value="{{ old('gst_number',$supplier->gst_number ?? '') }}" placeholder="GST Number">
                        <div class="invalid-feedback">{{ $errors->first('gst_number') }}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pan_number" class="form-label">PAN Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control valid @error('pan_number') is-invalid @enderror" id="pan_number" name="pan_number" value="{{ old('pan_number',$supplier->pan_number ?? '') }}" placeholder="PAN Number">
                        <div class="invalid-feedback">{{ $errors->first('pan_number') }}</div>
                    </div>

                    <div class="col-md-6">
                      <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                      <textarea class="form-control valid @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Address">{{ old('address',$supplier->address ?? '') }}</textarea>
                      <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ isset($supplier) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('supplier.list') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#supplierForm').on('submit', function(e) {
            e.preventDefault(); 
            let formData = $(this).serialize();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('.error-message').remove();
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
                url: "{{ route('save.supplier') }}", 
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        localStorage.setItem('successMessage', response.message);
                        window.location.href = '/admin/supplier/list'; 
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).siblings('.invalid-feedback').text(value[0]);
                        });
                    } 
                }
            });
    });
});
</script>
@endsection
