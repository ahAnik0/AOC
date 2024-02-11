{{-- @push('css') --}}
<style  nonce="{{ csp_nonce() }}">
   
   .logo-side .header1{
     color: white ; 
     line-height: 10px; 
     font-size: 15px; 
     margin-top: 20px
    }
    .span1{
     font-size: 12px ;
    }
    .demo3{
     margin-left: 0; 
     height: 80px
    }
 </style>
{{-- @endpush --}}

<header>
    <!-- Logo Section -->
    <div class="logo-section">
        
        <div class="container">
            <div class="row justify-content-around align-items-center">
                <div class="col-9">
                    <div class="logo-side d-flex">
                        <a href="{{route('home')}}"><img src="{{asset('assets/backend/images/logo/logo.PNG')}}" alt="" class="demo3"></a>
                        <div class="user_header header-logo-title">
                            <h1 class="header1">ARMY OFFICERS CLUB</h1>
                            <span class="span1"> Dhaka, Cantonment</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="user">
                        @if(\Illuminate\Support\Facades\Auth::guard('user')->user())
                            <a class="btn btn-green" href="{{route('user.userdashboard')}}">{{member_name()}}</a>
                        @else
                            <img src="{{asset("assets/frontend/img/icon/user.png")}}">
                            <div class="user-menu" lang="en">
                                <img src="{{asset("assets/backend/images/logo/logo.PNG")}}" height="100px">
                                <a class="btn btn-green" href="{{route('user.login')}}">Member Login</a>
                                <br>
                                <a class="btn btn-cyan" href="{{url('/aoc_admin/login')}}">Admin Login</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    
    <!-- Navigation Section -->
    <div class="navbar navbar-expand-md main-nav-section">
        
        <div class="container">
            
            <div class="navbar-collapse" id="navbarMain">
                
                <div class="menu-toggle">
                    <i class="fa fa-bars"></i>
                </div>
                <ul class="navbar-nav mr-auto" lang="bn">
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('hall_booking')}}">Hall Booking</a></li>
                    <li><a href="{{route('movie')}}">Movie</a></li>
                    {{--                    <li><a href="{{route('information')}}">Information</a></li>--}}
                    <li><a href="{{route('user.pay_bill')}}">Bill Payment</a></li>
                    <li><a href="{{route('notice')}}">Notice</a></li>
                    <li><a href="{{route('gallery')}}">Gallery</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                    
                    {{--						<li class="has-submenu">--}}
                    {{--                            <a href="#">আরও <i class="fa fa-caret-down"></i></a>                                    --}}
                    {{--                            <!-- <div class="mega-menu"> -->--}}
                    {{--                            <div class="mega-menu second-style">--}}
                    {{--                                <div class="bg-light">--}}
                    {{--                                    <div class="container">--}}
                    
                    {{--										<div class="person_section">--}}
                    {{--											<div class="item">--}}
                    {{--												<div class="img_container">--}}
                    {{--													<img src="assets/img/person/person_1.png" class="icon_img">--}}
                    {{--												</div>--}}
                    
                    {{--												<div class="text_area">--}}
                    {{--													<h1>সাংগঠনিক জিজ্ঞাসা</h1>--}}
                    {{--													<a href=""><p>আপনার মতামত দিন</p></a>--}}
                    {{--												</div>--}}
                    {{--											</div>--}}
                    
                    {{--											<div class="item">--}}
                    {{--												<div class="img_container">--}}
                    {{--													<img src="assets/img/person/person_2.png" class="icon_img">--}}
                    {{--												</div>--}}
                    {{--												<div class="text_area">--}}
                    {{--													<h1>নির্বাচনী প্রচারণা</h1>--}}
                    {{--													<a href=""><p>জরিপে অংশ নিন</p></a>--}}
                    {{--												</div>--}}
                    {{--											</div>--}}
                    {{--										</div>--}}
                    
                    {{--                                            --}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </li>--}}
                </ul>
            
            </div>
        
        </div>
    
    </div>
    
    <!-- Navigation Section -->
    <div class="navbar navbar-expand-md main-nav-section navbar-sticky">
        
        <div class="container">
            
            <div class="menu-toggle">
                <i class="fa fa-bars"></i>
            </div>
            
            <a class="logo" href=""><img src="{{asset('assets/backend/images/logo/logo.PNG')}}" alt=""></a>
            
            <div class="navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mr-auto" lang="bn">
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('hall_booking')}}">Hall Booking</a></li>
                    <li><a href="{{route('movie')}}">Movie</a></li>
                    {{--                    <li><a href="{{route('information')}}">Information</a></li>--}}
                    <li><a href="{{route('user.pay_bill')}}">Bill Payment</a></li>
                    <li><a href="{{route('notice')}}">Notice</a></li>
                    <li><a href="{{route('gallery')}}">Gallery</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                    
                    {{--						<li class="has-submenu">--}}
                    {{--                            <a href="#">আরও <i class="fa fa-caret-down"></i></a>                                    --}}
                    {{--                            <!-- <div class="mega-menu"> -->--}}
                    {{--                            <div class="mega-menu second-style">--}}
                    {{--                                <div class="bg-light">--}}
                    {{--                                    <div class="container">--}}
                    
                    {{--										<div class="person_section">--}}
                    {{--											<div class="item">--}}
                    {{--												<div class="img_container">--}}
                    {{--													<img src="assets/img/person/person_1.png" class="icon_img">--}}
                    {{--												</div>--}}
                    
                    {{--												<div class="text_area">--}}
                    {{--													<h1>সাংগঠনিক জিজ্ঞাসা</h1>--}}
                    {{--													<a href=""><p>আপনার মতামত দিন</p></a>--}}
                    {{--												</div>--}}
                    {{--											</div>--}}
                    
                    {{--											<div class="item">--}}
                    {{--												<div class="img_container">--}}
                    {{--													<img src="assets/img/person/person_2.png" class="icon_img">--}}
                    {{--												</div>--}}
                    {{--												<div class="text_area">--}}
                    {{--													<h1>নির্বাচনী প্রচারণা</h1>--}}
                    {{--													<a href=""><p>জরিপে অংশ নিন</p></a>--}}
                    {{--												</div>--}}
                    {{--											</div>--}}
                    {{--										</div>--}}
                    
                    {{--                                            --}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </li>--}}
                </ul>
                
                {{--					<div class="search-form-toggle">--}}
                {{--						<i id="search-toggle" class="fa fa-search"></i>--}}
                {{--						<form class="search-form form-inline">--}}
                {{--							<input class="form-control" type="text" placeholder="Search" aria-label="Search">--}}
                {{--							<button class="btn" type="submit"><i class="fa fa-search"></i></button>--}}
                {{--						</form>--}}
                {{--					</div>--}}
            </div>
        </div>
    </div>
    
    
    <!-- Mobile Navigation -->
    
    <div class="mobile-menu" id="mobile-menu">
        <ul>
            <li class="active"><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('hall_booking')}}">Hall Booking</a></li>
            <li><a href="{{route('movie')}}">Movie</a></li>
            <li><a href="{{route('information')}}">Information</a></li>
            <li><a href="{{route('user.pay_bill')}}">Bill Payment</a></li>
            <li><a href="{{route('notice')}}">Notice</a></li>
            <li><a href="{{route('gallery')}}">Gallery</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
            
            <!-- <li class="menu-item-has-children">
                <a href="">Mobile nav</a>
                <ul class="m-sub-menu">
                    <li><a href="">Mobile sub nav</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</header>
