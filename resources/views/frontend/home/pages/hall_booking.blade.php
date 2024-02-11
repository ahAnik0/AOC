@extends('frontend.home.app')
@section('title','Hall Booking')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/fullcalendar.min.css')}}">
    <style nonce="{{ csp_nonce() }}">
        .css1{
            height: 100%;
        }
    </style>
@endpush
@section('content')
    
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/notice_icon.png")}}">
                <h1>Hall Booking</h1>
            </div>
        </div>
    </section>
    
    <section class="notice-section">
        <div class="container">
            <div class="row justify-content-center">
                <div id="calendar" class="css1"></div>
                
                <div class="col-lg-6 mt-4">
                    <div class="notice-box border">
                        <h2>AOC-BOOKING RECEIPT</h2>
                        <div class="btn-set">
                            <a href="{{("assets/frontend/pdf/Booking From.pdf")}}" class="btn btn-dark"><i class="fa fa-eye"></i> Read More</a>
                            <a href="{{("assets/frontend/pdf/Booking From.pdf")}}" class="btn btn-green" download><i class="fa fa-download"></i> Download</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="inn-banner">
                        <div>
                            <h1>plz contact</h1>
                            <h2>01769047528 Booking hall (snk mostafis)</h2>
                        </div>
                        <a href="tel:+8801769047528" class="btn btn-coffee">Call</a>
                    </div>
                
                </div>
            
            
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{asset('assets/backend/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/fullcalendar.min.js')}}"></script>
    
    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                height: 700,
                editable: true,
                events: "{{ url('hall_booking_calender') }}",
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                    element.find('.fc-title').append(" <br> Prog:" + event.prog);
                },
                selectable: true,
                selectHelper: true,


                select: function (start, end, allDay) {
                    // var title = prompt('Event Name:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: "{{ url('admin/hall_booking/calendarEvents') }}",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                color: color,
                                type: 'create'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Event created.");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    color: color,
                                    allDay: allDay,
                                }, true);
                                element.find('.fc-title').append(" " + data.details);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endpush
