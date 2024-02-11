@extends('frontend.home.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/toastr.min.css') }}">
    <style nonce="{{ csp_nonce() }}">
        .css1 {
            width: 100%;
            background: #fff;
            padding: 23px 10px 10px 10px;
            margin-top: 12px;
            border-radius: 6px;
            color: #2C2D35;
            font-weight: 900;
            font-size: 16px;
            transition: .2s;
            position: relative;
            border: 0;
            outline: 2px solid #eee;
        }

        .css2 {
            font-weight: bold;font-size: 30px;text-align: center;line-height: 40px
        }

    </style>
@endpush
@section('content')

    <section class="inn-banner-section contact-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{ asset('assets/frontend/img/Contact_icon.png') }}">
                <h1>Plz Login to your account</h1>
            </div>
        </div>
    </section>
    <section class="contact-form-section">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <form action="{{ route('user.login') }}" method="post">
                        @csrf
                        <h2>Login</h2>
                        <div class="f-group">
                            <input type="text" id="member_id" placeholder=" " name="member_id"
                                value="{{ old('member_id') }}" required autocomplete="off">
                            @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="member_id">Member Id*</label>
                        </div>

                        <div class="f-group">
                            <input type="password" id="password" placeholder=" " name="password" required class="css1"
                                autocomplete="off">

                            {{--                                <div class="show-hide"><span class="show" onclick="myFunction()"></span></div> --}}
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="password">Password*</label>
                        </div>

                        <h4 class="info">* Forget Password</h4>

                        <button class="btn btn-green" type="submit">Login<i class="fa fa-angle-right"></i></button>

                    </form>

                </div>
                <div class="col-lg-6 pt-xs-5">
                    <div class="ct-photo">
                        <p class="css2">If you dont have
                            your password please contact: +8801769047530</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush
