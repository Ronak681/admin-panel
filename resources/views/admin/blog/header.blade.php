<div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="logo_mobile"><a href="#"><img src="{{asset('Blog_Template-main/images/logo.png')}}"></a></div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('blog.home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('blog.about')}}">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="#contact">Contact</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
               <div class="logo"><a href="#"><img src="{{asset('Blog_Template-main/images/logo.png')}}"></a></div>
               <div class="menu_main">
                  <ul>
                     <li class="active"><a href="{{ route('blog.home')}}">Home</a></li>
                     <li><a href="{{ route('blog.about')}}">About</a></li>
                    
                     <li><a href="{{ route('blog.service')}}">Blogs</a></li>
                     <li><a href="#contact">Contact us</a></li>
                  </ul>
               </div>
            </div>
         </div>