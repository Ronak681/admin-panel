@extends('frontend.layout.main')
@section('content')

    <!-- Blog Details Hero Begin -->
    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>{{ $post->title }}</h2>
                        <ul>
                            <li>By {{ $post->name }}</li>
                            <li>{{ \Carbon\Carbon::parse($post->date)->format('F j, Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="{{ asset('uploads/blog/'. $post->image)}}" width="=40px" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__share">
                            <span>share</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="blog__details__text">
                           {{ $post->content}}
                        </div>
                        {{-- <div class="blog__details__quote">
                            <i class="fa fa-quote-left"></i>
                            <p>“When designing an advertisement for a particular product many things should be
                                researched like where it should be displayed.”</p>
                            <h6>_ John Smith _</h6>
                        </div> --}}
                        {{-- <div class="blog__details__text">
                            <p>Vyo-Serum along with tightening the skin also reduces the fine lines indicating aging of
                                skin. Problems like dark circles, puffiness, and crow’s feet can be control from the
                                strong effects of this serum.</p>
                            <p>Hydroderm is a multi-functional product that helps in reducing the cellulite and giving
                                the body a toned shape, also helps in cleansing the skin from the root and not letting
                                the pores clog, nevertheless also let’s sweeps out the wrinkles and all signs of aging
                                from the sensitive near the eyes.</p>
                        </div> --}}
                        {{-- <div class="blog__details__option">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__author">
                                        <div class="blog__details__author__pic">
                                            <img src="{{asset('img/blog/details/blog-author.jpg')}}" alt="">
                                        </div>
                                        <div class="blog__details__author__text">
                                            <h5>Aiden Blair</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__tags">
                                        <a href="#">#Fashion</a>
                                        <a href="#">#Trending</a>
                                        <a href="#">#2020</a>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="" class="blog__details__btns__item">
                                        <p><span class="arrow_left"></span> Previous Pod</p>
                                        <h5>It S Classified How To Utilize Free Classified Ad Sites</h5>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="" class="blog__details__btns__item blog__details__btns__item--next">
                                        <p>Next Pod <span class="arrow_right"></span></p>
                                        <h5>Tips For Choosing The Perfect Gloss For Your Lips</h5>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <div class="comments">
                            <h4>Comments:</h4>
                            @foreach($post->comments as $comment)
                                <div class="comment">
                                    <strong>{{ $comment->name }}</strong> <span>{{ $comment->created_at->format('F j, Y') }}</span>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="blog__details__comment">
                            <h4>Leave A Comment</h4>
                            <form action="{{ route('save.comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                        @error('name')
                                          <p class="invalid-feedback text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" >
                                        @error('email')
                                          <p class="invalid-feedback text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" placeholder="Phone">
                                        @error('phone_no')
                                          <p class="invalid-feedback text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <textarea name="comment" placeholder="Comment" ></textarea>
                                        <button type="submit" class="site-btn">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        
            @if(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @endif

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });
    </script>
@endsection