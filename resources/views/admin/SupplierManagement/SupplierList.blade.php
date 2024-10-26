@extends('admin.layouts.main')
@section('content')
         <style>
            .label-success {
                background-color: green;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
            }
            .label-danger {
                background-color: red;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
            }
        </style>

<div class="container mt-4">
  <h1 class="mb-4">Supplier list</h1>
    <div class="mb-3">
        <form method="GET" class="mb-3">
            <div class="d-flex mb-2">
                <input type="text" class="form-control me-2" name="supplier_name" placeholder="Supplier Name" value="{{ request('supplier_name') }}">
                <input type="text" class="form-control me-2" name="email" placeholder="email" value="{{ request('email') }}">
                <input type="text" class="form-control me-2" name="phone_number" placeholder="phone Number" value="{{ request('phone_number') }}">
            </div>
            <button class="btn btn-outline-info me-2" type="submit"><i class="fa fa-search pr-2" aria-hidden="true"></i>Search</button>
            <a href="{{ route('supplier.list')}}" class="btn btn-outline-danger">Clear</a>
         </form>
        <div class="text-end mb-3">
            <a href="{{ route('add.supplier') }}" class="btn btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i>  Add Supplier</a>
        </div>
    </div>

    <div class="card shadow-lg border-0">
       
        <div class="card-body" style="overflow-x: auto;">
            <a href="{{ route('delete.allsupplier')}}" class="btn btn-danger">Delete All Selected</a>
            <div class="table-responsive pt-3">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th width="50px"><input type="checkbox" id="master"></th> 
                            <th>Supplier Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($suppliers->isNotEmpty())
                            @foreach($suppliers as $supplier)
                            <tr>
                                <td><input type="checkbox" name="id[]" class="sub_chk" data-id="{{$supplier->id}}"></td>  
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone_number }}</td>
                                <td>    
                                    @if($supplier->is_active == 1)
                                        <span class="label label-success">Activated</span>
                                    @else
                                        <span class="label label-danger">Deactivated</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('supplier.view', $supplier->id) }}" class="text-primary pr-3" title="View supplier"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('edit.supplier', $supplier->id) }}" class="text-dark pr-3" title="Edit Supplier"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ route('status.supplier', $supplier->id) }}" class="text-success pr-3 status-confirm" title="Change Status">
                                        @if($supplier->is_active == 0)
                                            <i class="fa fa-toggle-off text-danger" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('delete.supplier', $supplier->id) }}" class="text-danger delete-confirm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">No suppliers found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            

        </div>
        <div class="mb-3">
            <form method="GET" class="d-flex align-items-center">
                <label for="pagination_size" class="me-2">Show:  </label>
                <select id="pagination_size" name="size" class= "form-control me-2" onchange="this.form.submit()" style="width: auto;">
                    <option value="5" {{ request('size') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('size') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('size') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('size') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-right pt-3">
        {{ $suppliers->links('pagination::bootstrap-4') }}
    </div>
    <div>
        Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} results
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('adminn/assets/js/script.js')}}"></script>
<script type="text/javascript">  
    $(document).ready(function () {  
        $('#master').on('click', function() {  
            $(".sub_chk").prop('checked', this.checked);    
        });  

        $('.btn-danger').on('click', function(e) {  
          e.preventDefault();
          var ids = [];  
            $(".sub_chk:checked").each(function() {  
                ids.push($(this).data('id'));
            });  

            if (ids.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Suppliers Selected',
                    text: 'Please select at least one supplier to delete.',
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete.allsupplier') }}",  
                        type: 'POST',   
                        data: {
                            ids: ids,  
                            _token: '{{ csrf_token() }}'  
                        },
                        success: function (data) {  
                            if (data.success) {  
                                ids.forEach(function(id) {
                                    $('input[data-id="' + id + '"]').closest('tr').remove();
                                });

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: data.success,
                                    showConfirmButton: true
                                });
                            } 
                        },
                    });
                }
            });
        }); 
    });  
</script>  

@endsection
