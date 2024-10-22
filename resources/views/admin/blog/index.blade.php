<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>A World</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{asset('Blog_Template-main/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{asset('Blog_Template-main/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('Blog_Template-main/css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="{{asset('Blog_Template-main/images/fevicon.png')}}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('Blog_Template-main/css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="{{asset('Blog_Template-main/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('Blog_Template-main/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('admin.blog.header')
         <!-- banner section start -->
        @include('admin.blog.banner')
         <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- services section start -->
     <div class="services_section layout_padding">
         <div class="container">
            <h1 class="services_taital">Blog Posts </h1>
            <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
            <div class="services_section_2">
               <div class="row">
                  @foreach($posts as $posts)
                  <div class="col-md-4 pt-5 pb-5">
                     <div><img src="{{ asset('uploads/blog/'. $posts->image)}}" ></div>
                     <h4>{{ $posts->title }}</h4>

                     <p>Post by <b>{{ $posts->name }}</b></p>
                     <div class="btn_main"><a href="{{ route('blog.show',$posts->id)}}">Read More</a></div>
                  </div>
                  @endforeach
               
               </div>
            </div>
         </div>
      </div>
      <!-- services section end -->
      <!-- about section start -->
<div class="about_section layout_padding">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <div class="about_taital_main">
               <h1 class="about_taital">About Us</h1>
               <p class="about_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All </p>
            </div>
         </div>
         <div class="col-md-6 padding_right_0">
            <div><img src="{{asset('Blog_Template-main/images/about-img.png')}}" class="about_img"></div>
         </div>
      </div>
   </div>
</div>
      <!-- about section end -->
      <!-- blog section start -->
    
      <!-- blog section end -->
      <!-- client section start -->
      
      <!-- client section start -->
      <!-- choose section start -->
         
      <!-- choose section end -->
      <!-- footer section start -->
      @include('admin.blog.footer')
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>