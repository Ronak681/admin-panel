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
                                <a href="{{ route('add')}}" class="btn btn-primary">Add</a>
                            </div>

                             <div class="card-header bg-dark d-flex-justify-content-center aligin-items-center">
  
                               <h3 class="text-white pt-2"> Headings </h3>
                               
                             </div>
                             
                             <div class="card-body">
                                
                                <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        
                                        <th>Image</th>
                                        <th> heading</th>
                                        <th>title</th>
                                        <th>Description</th> 
                                        <th>Action</th>
                                   </tr>
                                   
                                   @if($header->isNotEmpty())
                                    @foreach($header as $header)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('/' . $header->image) }}"  width="100">
                                            </td>
                            
                                            <td>{{$header->heading}}</td>
                                            <td>{{$header->title}}</td>
                                            <td>{{$header->description}}</td>
                                            <td>
                                                <a href="{{ route('edit',$header->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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

 
         @endsection


