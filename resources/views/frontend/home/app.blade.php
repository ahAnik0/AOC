<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/backend/images/logo/logo.PNG')}}">
    
    <title>@yield('title') - {{ config('app.name', 'Army Officers Club') }}</title>
    
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" integrity="T5xaPlQfl1etSoFCqKdmLNHpv3NOQn2KQJoj6Pduxg4='" crossorigin="anonymous"> --}}

    <link rel="preconnect" href="https://fonts.gstatic.com" nonce="{{ csp_nonce() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"  nonce="{{ csp_nonce() }}">
   
    <link rel="stylesheet" href="{{asset("assets/frontend/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/frontend/css/meanmenu.css")}}">
    <link rel="stylesheet" href="{{asset("assets/frontend/css/style.css")}}">
    @stack('css')
</head>
<body>
{{-- <div class="overlay-inn1"></div> --}}
@include('frontend.home.pertial.header')
<main>
    @yield('content')
</main>
@include('frontend.home.pertial.footer')

