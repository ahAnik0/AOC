@extends('user.app')
@section('title','Pay monthly bill')
@push('css')
    <style  nonce="{{ csp_nonce() }}">
        .typewriter h1 {
            color: #f80369;
            font-family: monospace;
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            margin: 0 auto;
            font-size: 1.8vw;
            text-align: center;
            animation: typing 3.5s steps(30, end),
            blink-caret .5s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange
            }
        }

        @media screen and (max-width: 600px) {
            .typewriter h1 {
                font-size: 3vw;
                text-align: center;
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        .csss1{
            text-align: center;font-weight: bolder;
        }
        .csss2{
            text-align: center; font-size: 20px;
        }
        .csss3{
            display: none;
        }
    
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Pay monthly bill')
@section('link',route('user.userdashboard'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-xl-8">
                @if($number_of_due_month >= 3)
                    <div class="alert alert-danger" role="alert">
                        <p class="csss1">আপনার {{$number_of_due_month}} মাসের মাসিক বিল বকেয়া আছে। অনুগ্রহ করে বকেয়া বিল {{$number_of_due_month * 200}} টাকা
                            পরিষদ করে আপনার কার্ডটি একটিভ করুন।
                        </p>
                    </div>
                @endif
                <div class="card">
                    <form action="{{route('user.payViaAjax')}}" method="post">
                        @csrf
                        <div class="card-header pb-0">
                            <h5>Pay Your Monthly Bill</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item bg-warning csss2" ><span class="badge badge-danger ">Pay Your Card Bill</span></li>
                                <li class="list-group-item bg-warning csss2" ><span class="badge badge-danger ">Monthly Bill: 200 TK</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Issue Date<span class="badge bg-primary ">{{date("F j, Y",strtotime($member->issue_date))}}
                      </span></li>
                                {{--                                <li class="list-group-item d-flex justify-content-between align-items-center">Expire Date<span class="badge bg-info ">{{date("F j, Y",strtotime($member->expire_date))}}--}}
                                {{--                     </span></li>--}}
                                <li class="list-group-item d-flex justify-content-between align-items-center">Monthly Bill<span class="badge badge-primary ">200 TK</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-primary">Card will remain stable<span class="badge bg-danger">{{date("F j,
                                Y",strtotime($member->connection_to))}}
                   </span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-danger">User Status
                                    @if($member->status == 1)
                                        <span class="right badge badge-success float-right">Active</span>
                                    @elseif($member->status == 0)
                                        <span class="right badge badge-warning float-right">Suspended</span>
                                    
                                    @elseif($member->status == 2)
                                        <span class="right badge badge-danger float-right">Deleted</span>
                                    @endif
                                </li>
                                <br>
                            </ul>
                            <div class="typewriter csss3" id="output" >
                                <h1 id="show_value"></h1>
                            </div>
                            <div class="row justify-content-center">
                                <label for="number_of_month" class="col-md-12 col-form-label">Number of Month <small>
                                        ( আপনি কত মাসের বিল পরিশোধ করতে চাচ্ছেন তা লিখুন )</small></label>
                                <div class="col-md-12">
                                    @if($number_of_due_month >= 3)
                                        <input id="number_of_month" type="number" class="form-control" name="number_of_month" readonly value="{{$number_of_due_month}}">
                                    @else
                                        <input id="number_of_month" type="number" class="form-control" name="number_of_month">
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="total_amount" name="amount">
                            <input type="hidden" id="member_id" name="member_id" value="{{user_id()}}">
                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary w-100" id="pay_now_button" disabled="" onclick="iframeInitiate(this)">Pay your monthly bill</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"  nonce="{{ csp_nonce() }}"></script>
    <script src="https://merchant-pg-ui-prod.tadlbd.com/script.js" nonce="{{ csp_nonce() }}"></script>
    <script  nonce="{{ csp_nonce() }}">
        $(document).on('keyup', '#number_of_month', function () {
            var query = $(this).val();
            if (query != 0) {
                document.getElementById("output").style.display = "block";
                document.getElementById("pay_now_button").disabled = false;
                var monthly_bill = 200;
                var tot_price = query * monthly_bill;
                document.getElementById("total_amount").value = tot_price;
                $('#show_value').text('সর্বমোট ' + tot_price + ' টাকার বিল পরিশোধ করছেন ' + query + ' মাসের জন্য');
            } else {
                document.getElementById("output").style.display = "none";
                document.getElementById("pay_now_button").disabled = true;
            }
        });
        
        @if($number_of_due_month >= 3)
        var query = {{$number_of_due_month}};
        if (query != 0) {
            document.getElementById("output").style.display = "block";
            document.getElementById("pay_now_button").disabled = false;
            var monthly_bill = 200;
            var tot_price = query * monthly_bill;
            document.getElementById("total_amount").value = tot_price;
            $('#show_value').text('সর্বমোট ' + tot_price + ' টাকার বিল পরিশোধ করছেন ' + query + ' মাসের জন্য');
        } else {
            document.getElementById("output").style.display = "none";
            document.getElementById("pay_now_button").disabled = true;
        }
        @endif


        //---------------------------------- tab payment integration ---------------------------
        function iframeInitiate(param) {
            // 1. Getting the Access Token
            var settings = {
                url: "https://auth-prod.tadlbd.com/oauth/token",
                method: "POST",
                timeout: 0,
                headers: {
                    Authorization: "Basic YXJteS1vZmZpY2Vycy1jbHViOkdHMmJDd0dDdlA2Mnda",
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                data: {
                    grant_type: "password",
                    username: "army-officers-club-user",
                    password: "xtTl86ZPMAx5mM",
                },
                async: false,
            };

            $.ajax(settings).done(function (response) {
                // 2. Loading the iFrame
                tapIFrame($('body'), {
                    token: response.access_token,
                    authAPIKey: "9554b0b1-ed06-4d03-9267-a28498d96f3f",
                    paymentMode: "iFrame",
                    requestorReferenceId: {{user_id()}},
                    callBackUrl: '{{route('tappayment')}}',
                    amount: $("#total_amount").val(),
                    invoiceNumber: $("#number_of_month").val(),
                    additionalInformation: '{' + $("#number_of_month").val() + '}',
                    popUpCloseTimeOut: 3
                });
            });
        }

        // 3. Handle event
        function tapWindowClosed(payment) {
            if (payment.status = "completed") {
                window.location.href = "{{route('user.user_profile')}}";
            } else {
                toastr.error('Payment not success please try again', 'Warning');
            }
        }

        // Required
        function receiver(event) {
            console.log(event.data)
            if (event.origin != 'https://mwstaging.tadlbd.com') {
                console.log('mismatch');
                return;
            }

            if (event.data.func == "tapWindowClosed") {
                tapWindowClosed(event.data.param);
            }
        }

        // Required
        if (window.addEventListener) {
            window.addEventListener("message", receiver, false);
        } else {
            window.attachEvent("onmessage", receiver);
        }
    </script>
@endpush
