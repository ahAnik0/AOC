@extends('backend.app')
@section('title', 'Calendar View')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/fullcalendar.min.css') }}">
@endpush
@section('main_menu', 'Calendar View')
@section('active_menu', 'Serving Unit')
@section('link', '')
@section('content')
    <div class="row">
        <div id="calendar" ></div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/fullcalendar.min.js') }}"></script>
    @include('backend.hall_booking.calendar.calendar_js')
@endpush
