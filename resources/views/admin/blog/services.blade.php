@extends('admin.layouts.app')
@section('content')
<div class="services_section layout_padding">
         <div class="container">
            <h1 class="services_taital">Blog Posts </h1>
            <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
            <div class="services_section_2">
               <div class="row">
                  @foreach($posts as $post)
                  <div class="col-md-4 pt-5 pb-5">
                     <div><img src="{{ asset('uploads/blog/'. $post->image)}}" ></div>
                     <h4>{{ $post->title }}</h4>
                     <p>Post by <b>{{ $post->name }}</b></p>
                     <div class="btn_main"> <a href="{{ route('blog.show',$post->id)}}" onclick="readMore({{ $post->id }})">Read More</a></div>
                  </div>

                  @endforeach
                 
               
               </div>
            </div>
         </div>
      </div>
      
      @endsection
      <script>
         function readMore($post->id) {
            location.href =  "/blog/show/{$post->id}";
         }
         </script>
         