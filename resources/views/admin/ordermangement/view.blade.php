@extends('admin.layouts.main')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Order Details</h1>
    <div class="text-end mb-3">
        <a href="{{ route('purchase.list')}}" class="btn btn-danger">Back</a>
    </div>
    
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h3>Order Information</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Company Name</th>
                        <td>{{ $order->company_name }}</td>
                    </tr>
                    <tr>
                        <th>Supplier Name</th>
                        <td>{{ $order->supplier_name }}</td>
                    </tr>
                    <tr>
                        <th>Order Number</th>
                        <td>{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <td>{{ $order->serial_number }}</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ $order->remarks }}</td>
                    </tr>
                   
                    <tr>
                        <th>Delivery Date</th>
                        <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</td>
                        </tr>
                    <tr>
                        <th>Create Date</th>
                        <td>{{ \Carbon\Carbon::parse($order->create_date)->format('d/m/Y') }}</td>
                    </tr>
                </tbody>
            </table>

            <h3 class="mt-4">Order Items</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Style Name</th>
                            <th>Item Name</th>
                            <th>HSN Code</th>
                            <th>Color Name</th>
                            <th>Size Name</th>
                            <th>Quantity</th>
                            <th>Unit Name</th>
                            <th>Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($order->items))
                        @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->style_name }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->hsn_code }}</td>
                                    <td>{{ $item->color_name }}</td>
                                    <td>{{ $item->size_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit_name }}</td>
                                    <td>{{ $item->rate }}</td>
                                </tr>
                            @endforeach
                           
                        @else
                             <tr>
                                <td colspan="8" class="text-center">No items found for this order</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
