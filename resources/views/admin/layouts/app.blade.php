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
        
        
      </div>
       @yield('content')
    
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
      <script src="{{asset('Blog_Template-mainjs/jquery.min.js')}}"></script>
      <script src="{{asset('Blog_Template-mainjs/popper.min.js')}}"></script>
      <script src="{{asset('Blog_Template-mainjs/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('Blog_Template-mainjs/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('Blog_Template-mainjs/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('Blog_Template-mainjs/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('Blog_Template-mainjs/custom.js')}}"></script>
      <!-- javascript --> 
      <script src="{{asset('Blog_Template-mainjs/owl.carousel.js')}}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>