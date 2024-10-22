@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    
    <div class="text-end mb-3">
        <a href="{{ route('supplier.list')}}" class="btn btn-danger">Back</a>
    </div>
    
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h3>Supplier Information</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Supplier name</th>
                        <td>{{ $supplier->supplier_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $supplier->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $supplier->is_active ? 'Activate' : 'Deactivate' }}</td>
                    </tr>
                    <tr>
                        <th>country</th>
                        <td>{{ $supplier->country }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $supplier->state }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $supplier->city }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                    <tr>
                        <th>PinCode</th>
                        <td>{{ $supplier->pin_code }}</td>
                    </tr>
                    <tr>
                        <th>Gst Number</th>
                        <td>{{ $supplier->gst_number }}</td>
                    </tr>
                    <tr>
                        <th>Pan Number</th>
                        <td>{{ $supplier->pan_number }}</td>
                    </tr>
                </tbody>
            </table>          
        </div>
    </div>
</div>
@endsection
