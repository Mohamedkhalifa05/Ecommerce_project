<header class="main-header">

   
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix" style="margin-left: -16px;
              }">
                    <li><i class="far fa-map-marker-alt"></i>Discover St, New York, NY 10012, USA</li>
                    <li><i class="far fa-clock"></i>{{ date('m-d H:i:s') }}</li>
                    <li><i class="far fa-phone"></i><a href="tel:2512353256">+251-235-3256</a></li>
                    @auth
                    <li><i class="fas fa-user"></i><a style="text-decoration: none" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><i class="fas fa-user"></i><a style="text-decoration: none" href="{{ route('user.logout') }}">Logout</a></li>   
                    @else 
                    <li><i class="fas fa-user"></i><a style="text-decoration: none" href="{{ route('login') }}">Sign In</a></li>
                    @endauth 

                
                </ul>
            </div>
            <div class="right-column pull-right">
                {{-- <ul class="social-links clearfix">
                    <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
                </ul> --}}
        
            </div>
        </div>
    </div>
<!-- header-lower -->
<div class="header-lower">
<div class="outer-box">
    <div class="row">

<div class="main-box" >
        <div class="col-3">
<div class="logo-box">
<figure class="logo" style=""><a href="{{url('/')}}"><img style="margin-left: -36px" src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a></figure>
</div>
</div>
<div class="col-1"></div>
<div class="col-8">
<div class="menu-area clearfix" style="margin-left: -105px">
    
    <nav class="navbar navbar-expand-lg d-flex justify-content-between " style="margin-top:3px">
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> --}}
        
      
          <ul class="navbar-nav mr-2 mt-2 mt-lg-0 d-flex justify-content-around">
            <li class="nav-item dropdown home ">
              <a class="nav-link active dropdown-toggle" style="margin-right:7px;color:black;font-size:19px" 
              href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
              >Home <span class="sr-only">(current)</span></a>
              <div class="dropdown">
                <ul class="dropdown-menu">
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Main Home</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Home Modern</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Home Map</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Home Half Map</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Home Agent</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">OnePage Home</a></li>
                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">RTL Home</a></li>

                    {{-- <li><hr class="dropdown-divider"></li> --}}
                    <li class="nav-item dropend new" >
                        <a class="nav-link dropdown-toggle new"  style="margin-left: 16px;font-size:17px" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Header
                        </a>
                        
                        <div class="dropdown add">
                            
                                <ul class="dropdown-menu">
                                    <li class="li-a" ><a class="dropdown-item" style="font-size:17px" href="#">Header Style 01</a></li>
                                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Header Style 02</a></li>
                                    <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Header Style 03</a></li>

                                </ul>
                            
                          
                        </div>
                    </li>
                  </ul>

              </div>

                
               
                
              
            </li>
            
              <li class="nav-item dropdown list  ">
                <a class="nav-link dropdown-toggle" style=";font-size:19px ;margin-right:19px" 
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                >Listing</a>
                <div class="dropdown">
                  <ul class="dropdown-menu">
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agents List</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agents Grid</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agent Details</a></li>
                    </ul>
                </div>
  
              </li>
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" style="font-size:19px;margin-right:14px" 
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                >Property</a>
                <div class="dropdown">
                  <ul class="dropdown-menu">
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Property List</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Property List-Property List Full View</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Property Details 01</a></li>
                    </ul>
                </div>
                
              </li>
            
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" style="font-size:19px;margin-right:19px" 
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                >Pages</a>
                <div class="dropdown">
                  <ul class="dropdown-menu">

                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">About Us</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Our Services</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Faq's Page</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Pricing Table</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Compare Properties</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Categories Page</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Career Opportunity</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Testimonials</a></li>

                      
                    </ul>
                </div>
                
              </li>

              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" style="font-size:19px;margin-right:26px" 
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                >Agency</a>
                <div class="dropdown">
                  <ul class="dropdown-menu">

                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agency List</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agency Grid</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Agency Details</a></li>
                    </ul>
                </div>
                
              </li>
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" style="font-size:19px;margin-right:19px" 
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                >Blog</a>
                <div class="dropdown">
                  <ul class="dropdown-menu">

                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Blog 01</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Blog 01</a></li>
                      <li class="li-a"><a class="dropdown-item" style="font-size:17px" href="#">Blog Details</a></li>
                    </ul>
                </div>
                
              </li>
              
             
        
              <li class="nav-item">
                <a class="nav-link" style="font-size:19px;margin-right:-62px" href="#">Contact</a>
              </li>
          </ul>
         
          
        </div>
      </nav>
    </div>
</div>


{{--

                    <div class="col-xl-4 column">
                        <ul>
                            <li><h4>Pages</h4></li>
                            <li><a href="gallery.html">Our Gallery</a></li>
                            <li><a href="profile.html">My Profile</a></li>
                            <li><a href="signin.html">Sign In</a></li>
                            <li><a href="signup.html">Sign Up</a></li>
                            <li><a href="error.html">404</a></li>
                            <li><a href="agents-list.html">Agents List</a></li>
                            <li><a href="agents-grid.html">Agents Grid</a></li>
                            <li><a href="agents-details.html">Agent Details</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-4 column">
                        <ul>
                            <li><h4>Pages</h4></li>
                            <li><a href="blog-1.html">Blog 01</a></li>
                            <li><a href="blog-2.html">Blog 02</a></li>
                            <li><a href="blog-3.html">Blog 03</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                            <li><a href="agency-list.html">Agency List</a></li>
                            <li><a href="agency-grid.html">Agency Grid</a></li>
                            <li><a href="agency-details.html">Agency Details</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>                                   
                </div>                                        
            </div>
        </li> 
     
        <li class="dropdown"><a href="index.html"><span>Blog</span></a>
            <ul>
                <li><a href="blog-1.html">Blog 01</a></li>
                <li><a href="blog-2.html">Blog 02</a></li>
                <li><a href="blog-3.html">Blog 03</a></li>
                <li><a href="blog-details.html">Blog Details</a></li>
            </ul>
        </li>  
        <li><a href="contact.html"><span>Contact</span></a></li>   
    </ul>
</div>
</nav> --}}

</div>
</div>
</div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.html"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div>
            </div>
        </div>
    </div>
</header>

