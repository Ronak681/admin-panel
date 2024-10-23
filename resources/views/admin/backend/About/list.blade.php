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
                                <a href="{{route('about.add')}}" class="btn btn-primary">Add</a>
                            </div>

                             <div class="card-header bg-dark d-flex-justify-content-center aligin-items-center">
  
                               <h3 class="text-white pt-2"> About List </h3>
                               
                             </div>
                             
                             <div class="card-body">
                                
                                <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        
                                        <th>Image</th>
                                        <th> heading</th>
                                        
                                        <th>Description</th> 
                                        <th>Action</th>
                                   </tr>
                                   
                                   @if($about->isNotEmpty())
                                    @foreach($about as $about)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('/uploads/about/' . $about->image) }}"  width="100">
                                            </td>
                            
                                            <td>{{$about->heading}}</td>
                                            
                                            <td>{{$about->description}}</td>
                                            <td>
                                                <a href="{{ route('about.edit',$about->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="{{ route('about.delete',$about->id)}}" class="text-danger delete-confirm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

         </div>

         <script src="{{asset('adminn/assets/js/script.js')}}"></script>

         @endsection


