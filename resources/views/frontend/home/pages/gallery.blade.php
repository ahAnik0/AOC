@extends('frontend.home.app')
@section('title','Gallery')
@push('css')
    <link rel="stylesheet" href="{{asset("assets/frontend/css/lightgallery.css")}}">
@endpush
@section('content')
    <section class="inn-banner-section member-page gallery-page">
        <div class="container">
            <h1>Photo Gallery</h1>
        </div>
    </section>
    
    
    <section class="gallery-section">
        <div class="container">
            
            <div class="row no-gutters" id="lightgallery">
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/bowling/1.JPG")}}">
                    <img src="{{asset("assets/frontend/img/gallery/bowling/1.JPG")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/2.JPG")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/2.JPG")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/bowling/17.JPG")}}">
                    <img src="{{asset("assets/frontend/img/gallery/bowling/17.JPG")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/exterior 3d.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/exterior 3d.jpg")}}">
                </a>
                
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/bowling/15.JPG")}}">
                    <img src="{{asset("assets/frontend/img/gallery/bowling/15.JPG")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/practice hall.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/practice hall.jpg")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/conventionhall/1.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/conventionhall/1.jpg")}}">
                </a>
                
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/conventionhall/2.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/conventionhall/2.jpg")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/cafeteria1.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/cafeteria1.jpg")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/kid's pool.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/kid's pool.jpg")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/reception.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/reception.jpg")}}">
                </a>
                <a class="col-lg-4 col-md-6" href="{{asset("assets/frontend/img/gallery/offrclubpic/VIP lounge.jpg")}}">
                    <img src="{{asset("assets/frontend/img/gallery/offrclubpic/VIP lounge.jpg")}}">
                </a>
            </div>
        
        </div>
    </section>

@endsection
@push('js')
    <script src="{{asset("assets/frontend/js/vendor/lightgallery.min.js")}}" ></script>
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        try {
        lightGallery(document.getElementById('lightgallery'));
    } catch (e) {
        console.error("lightGallery has not initiated properly:", e);
    }
    </script>
@endpush
