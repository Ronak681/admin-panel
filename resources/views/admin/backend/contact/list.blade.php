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
                                <a href="{{ route('contact.add')}}" class="btn btn-primary">Add</a>
                            </div>

                             <div class="card-header bg-dark d-flex-justify-content-center aligin-items-center">
  
                               <h3 class="text-white pt-2"> Contact List </h3>
                               
                             </div>
                             
                             <div class="card-body">
                                
                                <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        
                                        <th> ID</th>
                                       
                                        <th>phone No.</th>
                                        <th>Address</th> 
                                        <th>Country</th>

                                        <th>Action</th>
                                   </tr>
                                   
                                   @if($contact->isNotEmpty())
                                    @foreach($contact as $contact)
                                        <tr>
                                          
                                            <td>{{$contact->id}}</td>
                                            <td>{{$contact->phone}}</td>
                                           

                                            <td>{{$contact->address}}</td>
                                            <td>{{$contact->country}}</td>
                                            <td>
                                                <a href="{{ route('contact.edit',$contact->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="{{ route('contact.delete',$contact->id)}}" class=" text-danger delete-confirm pl-3"><i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
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


