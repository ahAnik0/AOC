<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('app.name', 'Army Officers Club') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/backend/images/logo/logo.PNG') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/logo/logo.PNG') }}" type="image/x-icon">
    <meta name="description" content="Army Officres Club">
    <meta name="keywords" content="Army Officres Club">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/responsive.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/backend/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/toastr.min.css') }}">
    <style  nonce="{{ csp_nonce() }}">
    #img1{
        margin-left: 100px;
        height: 60px;
    }
    #stl_1{
        font-size: 18px;
        font-weight: bold
    }
    #stl_2{
        display: none;
    }
    </style>
    @stack('css')
</head>

<body>
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <div class="page-wrapper" id="pageWrapper">
        @include('backend.partial.header')
        <div class="page-body-wrapper horizontal-menu">
            @include('backend.partial.left_sidebar')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>@yield('title')</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">@yield('main_menu')</a></li>
                                    <li class="breadcrumb-item">@yield('active_menu')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid dashboard-default-sec">
                    @yield('content')
                </div>
            </div>
            @include('backend.partial.footer')
