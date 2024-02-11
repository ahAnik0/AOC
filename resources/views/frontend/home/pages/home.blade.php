@extends('frontend.home.app')
@section('title','Home')
@push('css')
<style  nonce="{{ csp_nonce() }}">
    .demo4{
        z-index: 0;
    }
</style>  
@endpush
@section('content')


    <section class="slider-section">
        <div class="col-md-12 banner_container">
            <div id="slider-image" class="carousel slide slider-image carousel-fade" data-ride="carousel">
                <div class="carousel-inner demo4" >
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset("assets/frontend/img/slider/1.jpg")}}" alt="">
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{asset("assets/frontend/img/slider/slider1.jpg")}}" alt="">
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{asset("assets/frontend/img/slider/slider2.jpg")}}" alt="">
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{asset("assets/frontend/img/slider/slider3.jpg")}}" alt="">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#slider-image" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slider-image" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    
    
    <section class="second_section pb-3">
        <div class="container">
            <div class="item_container row">
               
                <div class="col-md-4 col-sm-12">
                    <a href="{{route('notice')}}">
                        <div class="container_item  item_2">
                            <img src="{{asset("assets/frontend/img/icon/Icon_02.png")}}" alt="">
                            <p>Notice <i class="fas fa-angle-right ml-1"></i></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-12">
                    <a href="{{route('information')}}">
                        <div class="container_item item_1">
                            <img src="{{asset("assets/frontend/img/icon/info.png")}}" alt="">
                            <p>Information <i class="fas fa-angle-right ml-1"></i></p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <a href="{{route('contact')}}">
                        <div class="container_item item_3">
                            <img src="{{asset("assets/frontend/img/icon/Icon_03.png")}}" alt="">
                            <p>Contact <i class="fas fa-angle-right ml-1"></i></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container pb-4">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="col-title">Notice</h2>
                @foreach ($notice as $data )
                <div class="post-one bb">
                    <a href="{{route('notice')}}">
                        <p>{{$data->title}} - Notice । {{\Carbon\Carbon::create($data->date)->format('dF Y')}}</p>
                    </a>
                </div>
                @endforeach
               
            </div>
            
            <div class="col-lg-4">
                <h2 class="col-title">Information</h2>
                @foreach ($info as $data)
                <div class="post-one bb">
                    <a href="{{ route('information') }}">
                        <p>{{$data->title}} - Notice । {{\Carbon\Carbon::create($data->date)->format('dF Y')}}</p>
                    </a>
                </div>
                @endforeach
            </div>
            
            <div class="col-lg-4">
                <h2 class="col-title">Gallery</h2>
                
                <div id="photo-gallery" class="carousel slide photo-shongbad" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset("assets/frontend/img/gallery/tennis-court.jpg")}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset("assets/frontend/img/gallery/offrclubpic/Training class.jpg")}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset("assets/frontend/img/gallery/offrclubpic/pre function area.jpg")}}" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#photo-gallery" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#photo-gallery" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="pt-4 pb-4 bisas_protibadon">
        <div class="container">
            
            <h2 class="col-title">Gallery</h2>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="post-one bigger_section">
                                <a href="">
                                    <img src="{{asset('assets/frontend/img/gallery/offrclubpic/pre function area.jpg')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="post-one bigger_section">
                                <a href="">
                                    <img src="{{asset('assets/frontend/img/gallery/offrclubpic/multipurpose hall.jpg')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="post-one bigger_section">
                                <a href="">
                                    <img src="{{asset('assets/frontend/img/gallery/tennis-court.jpg')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="post-one bigger_section">
                                <a href="">
                                    <img src="{{asset('assets/frontend/img/gallery/cineplex.jpg')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                <div class="col-lg-4">
                    <div class="thread_sectin_right">
                        <img src="{{asset('assets/backend/images/logo/logo.PNG')}}">
                        <div class="text_content">
                            <h2>Army Officers Club</h2>
                            <p>Dhaka</p>
                        </div>
                        <img src="{{asset("assets/frontend/img/icon/info2.png")}}" class="icon_img">
                        <div class="button_contain">
                            <a href="{{route('information')}}">
                                <button>Information<i class="fas fa-angle-right ml-1"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
            
            </div>
        
        </div>
    </section>

@endsection
@push('js')
@endpush
