
@extends('admin.layouts.app')
@section('content')
<div class="services_section layout_padding">
<div class="container">

    <h1 ><b>{{ $post->title }}</b></h1>
    <div ><img width="500px"  src="{{ asset('uploads/blog/'. $post->image)}}" ></div>

   <p> Post by <b>{{ $post->name }}</b></p>

   {!! $post->content !!}

</div>  
</div>
@endsection

