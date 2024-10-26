
<section class="banner spad">
    <div class="container">
        <div class="row">
            @foreach($banners as $banner)
                <div class="col-lg-7 {{ $loop->index % 2 == 0 ? 'offset-lg-4' : '' }}">
                    <div class="banner__item {{ $loop->index == 2 ? 'banner__item--last' : ($loop->index == 1 ? 'banner__item--middle' : '') }}">
                        <div class="banner__item__pic">
                            @php
                                $activeIcon = $banner->icons->firstWhere('is_deleted', 0);
                            @endphp
                            <img src="{{ asset('uploads/banner/' . ($activeIcon->icon ?? 'default.jpg')) }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>{{ $banner->title }}</h2>
                            <a href="{{ route('frontend.index')}}">Shop now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
