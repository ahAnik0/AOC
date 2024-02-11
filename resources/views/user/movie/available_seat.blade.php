@extends('frontend.home.app')
@section('title','Movie')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/frontend/movie/css/seat.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/frontend/movie/css/style.css")}}"/>
    <style  nonce="{{ csp_nonce() }}">
        .css1{
        color: white; text-align: center; margin-left: 100px;font-weight: bold"

        }
    </style>
@endpush
@section('content')
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/icon/movie.png")}}">
                <h1>Book your seat</h1>
            </div>
        </div>
    </section>
    
    <section class="contact-form-section">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="st_seatlayout_main_wrapper float_left">
                        <div class="container container_seat">
                            <div class="st_seat_lay_economy_wrapper st_seat_lay_economy_wrapperexicutive float_left">
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">A</li>
                                        <li class="{{seat_check('a1',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c1" name="cb[]" value="a1"/>
                                            <label for="c1"></label>
                                        </li>
                                        <li class="{{seat_check('a2',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c2" name="cb[]" value="a2"/>
                                            <label for="c2"></label>
                                        </li>
                                        <li class="{{seat_check('a3',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c3" name="cb[]" value="a3"/>
                                            <label for="c3"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('a4',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c4" name="cb[]" value="a4"/>
                                            <label for="c4"></label>
                                        </li>
                                        <li class="{{seat_check('a5',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c5" name="cb[]" value="a5"/>
                                            <label for="c5"></label>
                                        </li>
                                        <li class="{{seat_check('a6',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c6" name="cb[]" value="a6"/>
                                            <label for="c6"></label>
                                        </li>
                                        <li class="{{seat_check('a7',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c7" name="cb[]" value="a7"/>
                                            <label for="c7"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('a8',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c8" name="cb[]" value="a8"/>
                                            <label for="c8"></label>
                                        </li>
                                        <li class="{{seat_check('a9',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c9" name="cb[]" value="a9"
                                            />
                                            <label for="c9"></label>
                                        </li>
                                        <li class="{{seat_check('a10',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c10" name="cb[]" value="a10"/>
                                            <label for="c10"></label>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- B -->
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">B</li>
                                        <li class="{{seat_check('b11',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c11" name="cb[]" value="b1"/>
                                            <label for="c11"></label>
                                        </li>
                                        <li class="{{seat_check('b12',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c12" name="cb[]" value="b2"/>
                                            <label for="c12"></label>
                                        </li>
                                        <li class="{{seat_check('b13',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c13" name="cb[]" value="b3"/>
                                            <label for="c13"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('b14',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c14" name="cb[]" value="b4"/>
                                            <label for="c14"></label>
                                        </li>
                                        <li class="{{seat_check('b15',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c15" name="cb[]" value="b5"/>
                                            <label for="c15"></label>
                                        </li>
                                        <li class="{{seat_check('b16',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c16" name="cb[]" value="b6"/>
                                            <label for="c16"></label>
                                        </li>
                                        <li class="{{seat_check('b17',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c17" name="cb[]" value="b7"/>
                                            <label for="c17"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('b18',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c18" name="cb[]" value="b8"/>
                                            <label for="c18"></label>
                                        </li>
                                        <li class="{{seat_check('b19',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c19" name="cb[]" value="b9"/>
                                            <label for="c19"></label>
                                        </li>
                                        <li class="{{seat_check('b20',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c20" name="cb[]" value="b10"/>
                                            <label for="c20"></label>
                                        </li>
                                    </ul>
                                </div>
                                <!-- C -->
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">C</li>
                                        <li class="{{seat_check('c21',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c21" name="cb[]" value="c1"/>
                                            <label for="c21"></label>
                                        </li>
                                        <li class="{{seat_check('c22',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c22" name="cb[]" value="c2"/>
                                            <label for="c22"></label>
                                        </li>
                                        <li class="{{seat_check('c23',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c23" name="cb[]" value="c3"/>
                                            <label for="c23"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('c24',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c24" name="cb[]" value="c4"/>
                                            <label for="c24"></label>
                                        </li>
                                        <li class="{{seat_check('c25',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c25" name="cb[]" value="c5"/>
                                            <label for="c25"></label>
                                        </li>
                                        <li class="{{seat_check('c26',$data['date'])}}">
                                            <input type="checkbox" id="c26" name="cb[]" value="c6"/>
                                            <label for="c26"></label>
                                        </li>
                                        <li class="{{seat_check('c27',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c27" name="cb[]" value="c7"/>
                                            <label for="c27"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('c28',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c28" name="cb[]" value="c8"/>
                                            <label for="c28"></label>
                                        </li>
                                        <li class="{{seat_check('c29',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c29" name="cb[]" value="c9"/>
                                            <label for="c29"></label>
                                        </li>
                                        <li class="{{seat_check('c30',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c30" name="cb[]" value="c10"/>
                                            <label for="c30"></label>
                                        </li>
                                    </ul>
                                </div>
                                <!-- D -->
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">D</li>
                                        <li class="{{seat_check('d1',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c31" name="cb[]" value="d1"/>
                                            <label for="c31"></label>
                                        </li>
                                        <li class="{{seat_check('d2',$data['date'])}}">
                                            <input type="checkbox" id="c32" name="cb[]" value="d2"/>
                                            <label for="c32"></label>
                                        </li>
                                        <li class="{{seat_check('d3',$data['date'])}}">
                                            <input type="checkbox" id="c33" name="cb[]" value="d3"/>
                                            <label for="c33"></label>
                                        </li>
                                        <li class="seat_disable margin-left-30">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c34" name="cb[]" value="d4"/>
                                            <label for="c34"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c35" name="cb[]" value="d5"/>
                                            <label for="c35"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <input type="checkbox" id="c36" name="cb[]" value="d6"/>
                                            <label for="c36"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c37" name="cb[]" value="d7"/>
                                            <label for="c37"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('d8',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c38" name="cb[]" value="d8"/>
                                            <label for="c38"></label>
                                        </li>
                                        <li class="{{seat_check('d9',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c39" name="cb[]" value="d9"/>
                                            <label for="c39"></label>
                                        </li>
                                        <li class="{{seat_check('d10',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c40" name="cb[]" value="d10"/>
                                            <label for="c40"></label>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="css1">Premium<br>Not for Sell</h3>
                                <!-- E -->
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">E</li>
                                        <li class="{{seat_check('e1',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c41" name="cb[]" value="e1"/>
                                            <label for="c41"></label>
                                        </li>
                                        <li class="{{seat_check('e2',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c42" name="cb[]" value="e2"/>
                                            <label for="c42"></label>
                                        </li>
                                        <li class="{{seat_check('e3',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c43" name="cb[]" value="e3"/>
                                            <label for="c43"></label>
                                        </li>
                                        <li class="seat_disable margin-left-30">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c44" name="cb[]" value="e4"/>
                                            <label for="c44"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c45" name="cb[]" value="e5"/>
                                            <label for="c45"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c46" name="cb[]" value="e6"/>
                                            <label for="c46"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c47" name="cb[]" value="e7"/>
                                            <label for="c47"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('e8',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c48" name="cb[]" value="e8"/>
                                            <label for="c48"></label>
                                        </li>
                                        <li class="{{seat_check('e9',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c49" name="cb[]" value="e9"/>
                                            <label for="c49"></label>
                                        </li>
                                        <li class="{{seat_check('e10',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c50" name="cb[]" value="e10"/>
                                            <label for="c50"></label>
                                        </li>
                                    </ul>
                                
                                </div>
                                
                                <div class="st_seat_lay_row">
                                    <ul>
                                        <li class="st_seat_heading_row">F</li>
                                        <li class="{{seat_check('f1',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c51" name="cb[]" value="f1"/>
                                            <label for="c51"></label>
                                        </li>
                                        <li class="{{seat_check('f2',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c52" name="cb[]" value="f2"/>
                                            <label for="c52"></label>
                                        </li>
                                        <li class="{{seat_check('f3',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c53" name="cb[]" value="f3"/>
                                            <label for="c53"></label>
                                        </li>
                                        <li class="seat_disable margin-left-30">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c54" name="cb[]" value="f4"/>
                                            <label for="c54"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c55" name="cb[]" value="f5"/>
                                            <label for="c55"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <input type="checkbox" id="c56" name="cb[]" value="f6"/>
                                            <label for="c56"></label>
                                        </li>
                                        <li class="seat_disable">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c57" name="cb[]" value="f7"/>
                                            <label for="c57"></label>
                                        </li>
                                        <li class="margin-left-30 {{seat_check('f8',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c58" name="cb[]" value="f8"/>
                                            <label for="c58"></label>
                                        </li>
                                        <li class="{{seat_check('f9',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c59" name="cb[]" value="f9"/>
                                            <label for="c59"></label>
                                        </li>
                                        <li class="{{seat_check('f10',$data['date'])}}">
                                            <span>Pay 100 TK</span>
                                            <input type="checkbox" id="c60" name="cb[]" value="f10"/>
                                            <label for="c60"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </section>
    
    <input type="hidden" value="{{$data['date']}}" id="booking_date">
    <input type="hidden" value="{{$data['movie_id']}}" id="movie_id">
    
    <div class="row justify-content-center">
        <a>
            <button class="btn btn-green btn-block" type="button" id="pay_now_button"
                    onclick="iframeInitiate(this)">Pay Now
            </button>
        </a>
    </div>
    
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z"></script>
    <script src="https://merchant-pg-ui-prod.tadlbd.com/script.js" nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        function total_amount() {
            var $checkboxes = $('input[type="checkbox"]');
            return countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        }

        function booked_seat() {
            var seats = [];
            $.each($("input[name='cb[]']:checked"), function () {
                seats.push($(this).val());
            });

            return seats;
        }


        //----------------------------------------------------- tab payment integration ---------------------------
        function iframeInitiate(param) {
            // 1. Getting the Access Token
            var settings = {
                url: "https://auth-prod.tadlbd.com/oauth/token",
                method: "POST",
                timeout: 0,
                headers: {
                    Authorization: "Basic YW9jLWNpbmVwbGV4OjNLOVNDWFphVlEzdlcz",
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                data: {
                    grant_type: "password",
                    username: "aoc-cineplex-user",
                    password: "i00m8V76dF22Dl",
                },
                async: false,
            };

            $.ajax(settings).done(function (response) {
                // 2. Loading the iFrame
                tapIFrame($('body'), {
                    token: response.access_token,
                    authAPIKey: "38ce381d-cebb-4aff-88ca-577608b7ab34",
                    paymentMode: "iFrame",
                    requestorReferenceId: {{user_id()}},
                    callBackUrl: '{{route('movie_payment')}}',
                    amount: total_amount() * 100,
                    invoiceNumber: '',
                    additionalInformation: '{' + booked_seat() + '|' + $('#booking_date').val() + '|' + $('#movie_id').val() + '}',
                    popUpCloseTimeOut: 3
                });
            });
        }

        // 3. Handle event
        function tapWindowClosed(payment) {
            if (payment.status = "completed") {
                window.location.href = "{{route('user.userdashboard')}}";
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
