@extends('admin.layouts.main')
@section('content')
<script src="{{asset('adminn/assets/js/script.js')}}"></script>
<div class="container mt-4">
    <h1 class="mb-4">Purchase Orders</h1>
    
    <div class="mb-3">
        <form method="GET" class="mb-3">
            <div class="d-flex mb-2">
                <input type="text" class="form-control me-2" name="company_name" placeholder="Company Name" value="{{ request('company_name') }}">
                <input type="text" class="form-control me-2" name="supplier_name" placeholder="Supplier Name" value="{{ request('supplier_name') }}">
                <input type="text" class="form-control me-2" name="serial_number" placeholder="Serial Number" value="{{ request('serial_number') }}">
                <input type="text" class="form-control datepicker me-2" name="create_date" id="create_date" readonly="readonly" placeholder="Create Date" value="{{ request('create_date') }}">
            </div>
            <button class="btn btn-outline-secondary me-2" type="submit">Search</button>
            <a href="{{ route('purchase.list')}}" class="btn btn-danger">Clear</a>
             </form>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="text-end mb-3">
            <a href="{{ route('order.add') }}" class="btn btn-primary">Add Order</a>
        </div>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Company Name</th>
                            <th>Supplier Name</th>
                            <th>Order Number</th>
                            <th>Serial Number</th>
                            <th>Delivery Date</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders->isNotEmpty())
                        @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->supplier_name }}</td>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->serial_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->create_date)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('order.view', $order->id) }}" class="text-primary pr-3" title="View Order"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{ route('order.edit', $order->id) }}" class="text-dark pr-3" title="Edit Order"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="{{ route('order.delete', $order->id) }}" class="text-danger delete-confirm" title="Delete Order"> <i class="fa fa-trash" aria-hidden="true"></i></a>  
                                    </td>
                                </tr>
                            @endforeach
                           
                        @else
                        <tr>
                                <td colspan="7" class="text-center">No orders found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-right pt-3">
       {{ $orders->links('pagination::bootstrap-4') }}
    </div>
    <div>
        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
    </div>
</div>
<script>
        $(function() {
        $('#create_date').datepicker({
            dateFormat: 'yy-mm-dd' 
        });
    });
</script>


@endsection
