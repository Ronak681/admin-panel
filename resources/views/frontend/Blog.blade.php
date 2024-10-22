@extends('frontend.layout.main')
@section('content')
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="{{asset('img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Blog</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ asset('uploads/blog/' . $post->image) }}"></div>
                                <div class="blog__item__text">
                                    <span><img src="{{ asset('img/icon/calendar.png') }}" alt=""> {{ \Carbon\Carbon::parse($post->date)->format('d F Y') }}</span>
                                    <h5>{{ $post->title }}</h5>
                                    <a href="{{ route('Blog.details',$post->id)}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
@endsection