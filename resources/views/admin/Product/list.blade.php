@extends('admin.layouts.main')
@section('content')
<div class="container">
    
    <div class="row-d-flex justify-content-center">
        @if(Session::has('success'))
        <div class="col-md-15 mt-4">
            <div class="alert alert-success">
            {{Session::get('success')}}
            </div>
            @endif
        </div>
        <div class="row justify-content-center mt-1">
                  
                     <div class="col-md-11">
                       
                        <div class="card">
                            
                           
                         <div class="card-border-0 shadow-lg my-5"> 
                            <div class="text-end mb-3">
                                <a href="{{ route('admin.create')}}" class="btn btn-primary">Add Product</a>
                            </div>

                             <div class="card-header bg-dark d-flex-justify-content-center aligin-items-center">
  
                               <h3 class="text-white pt-2"> Product </h3>
                               
                             </div>
                             
                             <div class="card-body">
                                
                                <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        
                                        {{-- <th>Image</th> --}}
                                        <th> Name</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Description</th> 
                                        <th>Categories</th> 
                                        <th>Action</th>
                                   </tr>
                                   
                                   @if($products->isNotEmpty())
                                    @foreach($products as $product)
                                        <tr>
                                           
                                            {{-- <td>
                                                @if(!empty($product->image) && is_array($product->image) && count($product->image) > 0)
                                                    <img width="50" src="{{ asset('uploads/products/' . $product->image[0]) }}" alt="{{ $product->name }}">
                                                @endif
                                            </td>  --}}
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->product}}</td>
                                            <td>Rs.{{$product->price}}</td>
                                            <td>Rs.{{$product->discount_price}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>
                                                @if($product->categories->isNotEmpty())
                                                    @foreach($product->categories as $category)
                                                        {{ $category->title}}
                                                        @if(!$loop->last), @endif 
                                                    @endforeach
                                                @else
                                                    No Categories
                                                @endif
                                            </td>
                                           {{-- <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>  --}}

                                            <td>
                                                <a href="/admin/edit/{{ ($product->id) }}" class="text-primary pr-2"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin.destroy',$product->id)}}" class="text-danger delete-confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                             </div>
                         </div>
                     </div>
                     {{-- {{ $products->links() }} --}}


        
         </div>

 
         @endsection


