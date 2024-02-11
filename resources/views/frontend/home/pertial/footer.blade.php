{{-- @push('css') --}}
    <style nonce="{{ csp_nonce() }}">
        .sec1 {
            background: #c5e5da;
        }

        .header2 {
            text-align: center;
        }

        .img01  {
            width: 100%;
        }

        .header3 {
            color: red;
            line-height: 20px;
            font-size: 20px;
        }

        .span2 {
            color: red;
        }

        .ul1 {
            list-style: none;
            text-align: left;
            color: black;
        }

        .li1 {
            color: black;
        }

        .demo {
            width: 100%;
        }

        .demo p {
            text-align: center;
        }

        .demo2 {
            margin-left: 0;
            height: 80px
        }
    </style>
{{-- @endpush --}}
<footer class="footer bg-white">

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="person_section">
                <div class="item">
                    <div class="img_container">
                        <img src="{{ asset('assets/frontend/img/person/person_1.png') }}" class="icon_img">
                    </div>

                    <div class="text_area">
                        <h1>Contact With Us</h1>
                        <a href="{{ route('contact') }}">
                            <p>Feel free to contact with us</p>
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="img_container">
                        <img src="{{ asset('assets/frontend/img/person/person_2.png') }}" class="icon_img">
                    </div>
                    <div class="text_area">
                        <h1>Gallery</h1>
                        <a href="{{ route('gallery') }}">
                            <p>View all images</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-3 pb-3 sec1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="header2">We accept</h1>
                    <img class="img01" src="{{ asset('assets/frontend/img/ssl_payment.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="pt-3">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="logo-side d-flex align-items-center">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/backend/images/logo/logo.PNG') }}"
                                alt="" class="demo2"></a>
                        <div class="user footer-logo-title">
                            <h1 class="header3">ARMY OFFICERS CLUB</h1>

                            <span class="span2">Dhaka, Cantonment</span>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="social_icons">
                        {{--                        <h2>Useful Link</h2> --}}
                        <ul class="ul1">
                            <li class="li1"><a href="{{ route('about_us') }}">ABOUT US</a></li>
                            <li class="li1"><a href="{{ route('privacy_policy') }}">PRIVACY POLICY</a></li>
                            <li class="li1"><a href="{{ route('terms_condition') }}">TERMS & CONDITION</a></li>
                            <li class="li1"><a href="{{ route('refund_policy') }}">RETURN & REFUND POLICY</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<div class="demo1">
    <p>Developed by <a href="https://www.tilbd.net" target="_blank">Trust Innovation Limited</a></p>
</div>

<script src="{{ asset('assets/frontend/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/jquery.meanmenu.js') }}" ></script>
<script src="{{ asset('assets/frontend/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/lightgallery.min.js') }}"></script>
<script type="module" src="{{ asset('assets/frontend/js/vendor/lg-utils.js') }}" ></script>
<script src="{{ asset('assets/frontend/js/vendor/lg-video.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/lg-video.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/fontawesome/fontawesome.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main-script.js') }}"></script>
<script type="text/javascript" nonce="{{ csp_nonce() }}">
    lightGallery(document.getElementById('lightgallery'));
</script>
@stack('js')
</body>

</html>
