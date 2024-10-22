@extends('admin.layouts.main')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container">
@if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
    @endif
        <div class="row justify-content-center mt-1">
                     <div class="col-md-4 d-flex-justify-content-center">
                     </div>
                     <div class="col-md-11">
                         <div class="card-border-0 shadow-lg my-5"> 
                         <div class="text-end">
                            <a href="{{ route('blog.post')}}" class="btn btn-primary"> Add Post</a>
                         </div>
                             <div class="card-header bg-light ">
                               <h2 class="text-dark"> All post</h2>
                             </div>
                             <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Id</th>
                                        <th>title</th>
                                        <th>Name</th>
                                        <th>Post status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                      @foreach($post as $post)
                                      <tr>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->name}}</td>
                                        <td>{{$post->post_status}}</td>
                                        <td>
                                        <a href="{{ route('blog.edit',$post->id) }}" class="btn btn-success">Edit</a>  
                                        <a href="{{ route('blog.delete',$post->id) }}" onclick="return confirmation(event)"class="btn btn-danger">Delete</a>

                                    </td>
                                      </tr>
                                      @endforeach

                                </table>
                                </div>
                            </div>
                        </div>        
   </div>
</div>
<script>
    function confirmation(ev){
        ev.preventDefault();
        var url=ev.currentTarget.getAttribute('href');
     swal({
            title:"Are you sure you want to delete this ",
            icon: "info",
            
            buttons:true,
        }) 
        .then((willCancel)=>
        {
            if(willCancel){
                window.location.href=url
            }
        })

    }
   
</script>


@endsection