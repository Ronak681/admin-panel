<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach($header as $header)
        <div class="hero__items set-bg" data-setbg="{{ asset('/uploads/hero/' . $header->image) }}" style="background-image: url({{ asset('/uploads/hero/' . $header->image) }})" alt="df">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{ $header->heading }}</h6>
                            <h2>{{ $header->title }}</h2>
                            <p>{{ $header->description }}</p>
                            <a href="{{ route('shop')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
