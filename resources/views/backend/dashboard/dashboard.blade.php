@extends('backend.app')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/animate.css') }}">
    <style nonce="{{ csp_nonce() }}">
        .card_height {
            padding: 25px !important;
        }

        .css1 {
            font-size: 45px;
        }
    </style>
@endpush
@section('main_menu', 'Dashboard')
@section('active_menu', 'Dashboard')
@section('content')


    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-users css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total member</span>
                            <h4 class="mb-0 counter">{{ $total_member }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-user css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Active Member</span>
                            <h4 class="mb-0 counter">{{ $active_member }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-danger b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-user-times css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Inactive Member</span>
                            <h4 class="mb-0 counter">{{ $inactive_member }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-info b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-film css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total Movie ticket sell</span>
                            <h4 class="mb-0 counter">{{ $movie_ticket_sell }} TK</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-film css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total Service sell</span>
                            <h4 class="mb-0 counter">{{ $total_service_sell }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-film css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total Book Sold</span>
                            <h4 class="mb-0 counter">{{ $total_book_rent }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-danger b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-film css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total Payment</span>
                            <h4 class="mb-0 counter">{{ $total_payment }} Tk</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-3">
            <div class="card o-hidden border-0">
                <div class="bg-info b-r-4 card-body card_height">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i class="fa fa-film css1"></i>
                        </div>
                        <div class="media-body"><span class="m-0">Total Payment(today)</span>
                            <h4 class="mb-0 counter">{{ $total_payment }} Tk</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('backend.dashboard.dashboard_chart')

@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/chart/chartjs/Chart.js') }}" nonce="{{ csp_nonce() }}"></script>
    <script nonce="{{ csp_nonce() }}">
        var background = ["rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgba(255, 206, 86, 0.6)",
            "rgb(74,179,29,0.6)", "rgba(153, 102, 255, 0.6)", "rgba(179,61,85,0.6)", "rgb(176,20,93,0.6)",
            "rgb(28,151,208,0.6)", "rgba(75, 192, 192, 0.6)", "rgba(153, 102, 255, 0.6)", "rgb(229,121,27,0.6)",
            "rgb(235,60,54,0.6)", "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)",
            "rgba(179,61,85,0.6)", "rgb(7,33,165,0.6)", "rgb(25,27,29,0.6)", "rgb(116,44,196,0.6)", "rgb(96,7,102,0.6)",
            "rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgb(100,110,21,0.6)", "rgb(31,134,58,0.6)",
            "rgba(92,0,255,0.6)", "rgb(131,23,113,0.6)", "rgb(96,233,56,0.6)", "rgb(28,151,208,0.6)",
            "rgb(190,170,10,0.6)", "rgba(67,22,155,0.6)", "rgb(229,121,27,0.6)", "rgba(117,26,24,0.6)",
            "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)", "rgb(246,0,255)",
            "rgb(62,167,33,0.6)", "rgb(153,9,9,0.6)", "rgb(11,185,217,0.6)", "rgb(96,7,102,0.6)",
        ];
        background = background.sort(() => Math.random() - 0.5);

        // function csp_nonce() {
        //     // Generate a random nonce value
        //     var nonce = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        //     return nonce;
        // }

        $.ajax({
            url: "{{ url('admin/payment_history_report') }}/payment",
            type: "GET",
            data: {},
            success: function(response) {
                if (response) {
                    if (response.permission == false) {
                        toastr.error('you dont have that Permission to see report chart', 'Permission Denied');
                    } else {
                        var ctx = document.getElementById('payment_history').getContext('2d');
                        // ctx.canvas.setAttribute('nonce', csp_nonce());
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: response.lebel,
                                datasets: [{
                                    label: 'Total Amount',
                                    data: response.data,
                                    backgroundColor: background,
                                    borderColor: ['rgba(255,99,132,1)'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });

                    }
                }
            },
            error: function(response) {
                if (response.responseJSON && response.responseJSON.errors && response.responseJSON.errors
                    .username) {
                    $('#usernameError').text(response.responseJSON.errors.username);
                } else {
                    // Handle other types of errors or unexpected response structures
                    // For example, you can display a generic error message
                    toastr.error('An error occurred while processing your request.', 'Error');
                }
            }
        });

        $.ajax({
            url: "{{ url('admin/payment_history_report') }}/movie_chart",
            type: "GET",
            data: {},
            success: function(response) {
                if (response) {
                    if (response.permission == false) {
                        toastr.error('you dont have that Permission to see report chart', 'Permission Denied');
                    } else {
                        var ctx = document.getElementById('movie_chart').getContext('2d');
                        // ctx.canvas.setAttribute('nonce', csp_nonce());
                        var myChart = new Chart(ctx, {
                            type: 'polarArea',
                            data: {
                                labels: response.lebel,
                                datasets: [{
                                    label: 'Total Amount',
                                    data: response.data,
                                    backgroundColor: background,
                                    borderColor: ['rgba(255,99,132,1)', ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            },
            error: function(response) {
                $('#usernameError').text(response.responseJSON.errors.username);
            }
        });

        $.ajax({
            url: "{{ url('admin/payment_history_report') }}/service",
            type: "GET",
            data: {},
            success: function(response) {
                if (response) {
                    if (response.permission == false) {
                        toastr.error('you dont have that Permission to see report chart', 'Permission Denied');
                    } else {
                        var ctx = document.getElementById('service_chart').getContext('2d');
                        // ctx.canvas.setAttribute('nonce', csp_nonce());
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: response.lebel,
                                datasets: [{
                                    label: 'Total Amount',
                                    data: response.data,
                                    backgroundColor: background,
                                    borderColor: ['rgba(255,99,132,1)', ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            },
            error: function(response) {
                $('#usernameError').text(response.responseJSON.errors.username);
            }
        });

        $.ajax({
            url: "{{ url('admin/payment_history_report') }}/bowling",
            type: "GET",
            data: {},
            success: function(response) {
                if (response) {
                    if (response.permission == false) {
                        toastr.error('you dont have that Permission to see report chart', 'Permission Denied');
                    } else {
                        var ctx = document.getElementById('bowling_chart').getContext('2d');
                        // ctx.canvas.setAttribute('nonce', csp_nonce());
                        var myChart = new Chart(ctx, {
                            type: 'horizontalBar',
                            data: {
                                labels: response.lebel,
                                datasets: [{
                                    label: 'Total Amount',
                                    data: response.data,
                                    backgroundColor: background,
                                    borderColor: ['rgba(255,99,132,1)', ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            },
            error: function(response) {
                $('#usernameError').text(response.responseJSON.errors.username);
            }
        });

        $.ajax({
            url: "{{ url('admin/payment_history_report') }}/salon",
            type: "GET",
            data: {},
            success: function(response) {
                if (response) {
                    if (response.permission == false) {
                        toastr.error('you dont have that Permission to see report chart', 'Permission Denied');
                    } else {
                        var ctx = document.getElementById('salon_chart').getContext('2d');
                        // ctx.canvas.setAttribute('nonce', '{{ csp_nonce() }}');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: response.lebel,
                                datasets: [{
                                    label: 'Total Amount',
                                    data: response.data,
                                    backgroundColor: background,
                                    borderColor: ['rgba(255,99,132,1)', ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            },
            error: function(response) {
                $('#usernameError').text(response.responseJSON.errors.username);
            }
        });
    </script>
@endpush
