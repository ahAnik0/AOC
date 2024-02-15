@extends('backend.app')
@section('title', 'See Available seat')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/movie/css/seat.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/movie/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/jquery-ui.css') }}" />
    <style nonce="{{ csp_nonce() }}">
        .st_seat_lay_row li {
            width: 40px;
            height: 40px;
            /* margin: 0px 0; */
            display: inline-block;
            position: relative;
            /* margin-top: 3px; */
            /* padding-top: 0px; */
        }

        .st_seat_heading_row {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.38);
            letter-spacing: 1px;
            font-weight: 200;
            text-align: center;
            text-transform: uppercase;
            padding-top: 14px;
        }

        .st_seatlayout_main_wrapper {
            padding-top: 0;
            padding-bottom: 20px;
            background: #000000;
        }

        .st_seat_lay_economy_wrapperexicutive {
            margin-top: 0;
        }

        .css_1 {
            margin-top: 30px;
        }

        /*.st_seat_lay_row ul{*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*}*/
    </style>
@endpush
@section('main_menu', 'Home')
@section('active_menu', 'See Available seat')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Available Seat for - {{ request()->date }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-9">
                                {{-- <div class="mb-3">
                                    <label class="col-form-label">Date</label>
                                    <input class="form-control" type="date" name="date" id="date"
                                        value="{{ request()->date }}">
                                    <span id="error_movie_name" class="text-danger error_field"></span>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="col-form-label">Date</label>
                                    <input class="form-control" type="text" name="date" id="date"
                                        value="{{ request()->date }}">
                                    <span id="error_movie_name" class="text-danger error_field"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <button class="btn btn-success css_1" onclick="set_date()">Set Date</button>
                                </div>
                            </div>
                        </div>
                        <div class="st_seatlayout_main_wrapper float_left">
                            <div class="container container_seat">
                                <div class="st_seat_lay_economy_wrapper st_seat_lay_economy_wrapperexicutive float_left">
                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">A</li>
                                            <li class="{{ seat_check('a1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c1" name="cb[]" value="a1" />
                                                <label for="c1"></label>
                                            </li>
                                            <li class="{{ seat_check('a2', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c2" name="cb[]" value="a2" />
                                                <label for="c2"></label>
                                            </li>
                                            <li class="{{ seat_check('a3', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c3" name="cb[]" value="a3" />
                                                <label for="c3"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('a4', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c4" name="cb[]" value="a4" />
                                                <label for="c4"></label>
                                            </li>
                                            <li class="{{ seat_check('a5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c5" name="cb[]" value="a5" />
                                                <label for="c5"></label>
                                            </li>
                                            <li class="{{ seat_check('a6', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c6" name="cb[]" value="a6" />
                                                <label for="c6"></label>
                                            </li>
                                            <li class="{{ seat_check('a7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c7" name="cb[]" value="a7" />
                                                <label for="c7"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('a8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c8" name="cb[]" value="a8" />
                                                <label for="c8"></label>
                                            </li>
                                            <li class="{{ seat_check('a9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c9" name="cb[]" value="a9" />
                                                <label for="c9"></label>
                                            </li>
                                            <li class="{{ seat_check('a10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c10" name="cb[]" value="a10" />
                                                <label for="c10"></label>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- B -->
                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">B</li>
                                            <li class="{{ seat_check('b1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c11" name="cb[]" value="b1" />
                                                <label for="c11"></label>
                                            </li>
                                            <li class="{{ seat_check('b2', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c12" name="cb[]" value="b2" />
                                                <label for="c12"></label>
                                            </li>
                                            <li class="{{ seat_check('b3', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c13" name="cb[]" value="b3" />
                                                <label for="c13"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('b4', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c14" name="cb[]" value="b4" />
                                                <label for="c14"></label>
                                            </li>
                                            <li class="{{ seat_check('b5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c15" name="cb[]" value="b5" />
                                                <label for="c15"></label>
                                            </li>
                                            <li class="{{ seat_check('b6', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c16" name="cb[]" value="b6" />
                                                <label for="c16"></label>
                                            </li>
                                            <li class="{{ seat_check('b7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c17" name="cb[]" value="b7" />
                                                <label for="c17"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('b8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c18" name="cb[]" value="b8" />
                                                <label for="c18"></label>
                                            </li>
                                            <li class="{{ seat_check('b9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c19" name="cb[]" value="b9" />
                                                <label for="c19"></label>
                                            </li>
                                            <li class="{{ seat_check('b10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c20" name="cb[]" value="b10" />
                                                <label for="c20"></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- C -->
                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">C</li>
                                            <li class="{{ seat_check('c1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c21" name="cb[]" value="c1" />
                                                <label for="c21"></label>
                                            </li>
                                            <li class="{{ seat_check('c2', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c22" name="cb[]" value="c2" />
                                                <label for="c22"></label>
                                            </li>
                                            <li class="{{ seat_check('c3', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c23" name="cb[]" value="c3" />
                                                <label for="c23"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('c4', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c24" name="cb[]" value="c4" />
                                                <label for="c24"></label>
                                            </li>
                                            <li class="{{ seat_check('c5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c25" name="cb[]" value="c5" />
                                                <label for="c25"></label>
                                            </li>
                                            <li class="{{ seat_check('c6', request()->date) }}">
                                                <input type="checkbox" id="c26" name="cb[]" value="c6" />
                                                <label for="c26"></label>
                                            </li>
                                            <li class="{{ seat_check('c7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c27" name="cb[]" value="c7" />
                                                <label for="c27"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('c8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c28" name="cb[]" value="c8" />
                                                <label for="c28"></label>
                                            </li>
                                            <li class="{{ seat_check('c9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c29" name="cb[]" value="c9" />
                                                <label for="c29"></label>
                                            </li>
                                            <li class="{{ seat_check('c10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c30" name="cb[]" value="c10" />
                                                <label for="c30"></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- D -->
                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">D</li>
                                            <li class="{{ seat_check('d1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c31" name="cb[]" value="d1" />
                                                <label for="c31"></label>
                                            </li>
                                            <li class="{{ seat_check('d2', request()->date) }}">
                                                <input type="checkbox" id="c32" name="cb[]" value="d2" />
                                                <label for="c32"></label>
                                            </li>
                                            <li class="{{ seat_check('d3', request()->date) }}">
                                                <input type="checkbox" id="c33" name="cb[]" value="d3" />
                                                <label for="c33"></label>
                                            </li>
                                            <li class="{{ seat_check('d4', request()->date) }} margin-left-30">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c34" name="cb[]" value="d4" />
                                                <label for="c34"></label>
                                            </li>
                                            <li class="{{ seat_check('d5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c35" name="cb[]" value="d5" />
                                                <label for="c35"></label>
                                            </li>
                                            <li class="{{ seat_check('d6', request()->date) }}">
                                                <input type="checkbox" id="c36" name="cb[]" value="d6" />
                                                <label for="c36"></label>
                                            </li>
                                            <li class="{{ seat_check('d7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c37" name="cb[]" value="d7" />
                                                <label for="c37"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('d8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c38" name="cb[]" value="d8" />
                                                <label for="c38"></label>
                                            </li>
                                            <li class="{{ seat_check('d9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c39" name="cb[]" value="d9" />
                                                <label for="c39"></label>
                                            </li>
                                            <li class="{{ seat_check('d10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c40" name="cb[]" value="d10" />
                                                <label for="c40"></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- E -->
                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">E</li>
                                            <li class="{{ seat_check('e1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c41" name="cb[]" value="e1" />
                                                <label for="c41"></label>
                                            </li>
                                            <li class="{{ seat_check('e2', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c42" name="cb[]" value="e2" />
                                                <label for="c42"></label>
                                            </li>
                                            <li class="{{ seat_check('e3', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c43" name="cb[]" value="e3" />
                                                <label for="c43"></label>
                                            </li>
                                            <li class="{{ seat_check('e4', request()->date) }} margin-left-30">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c44" name="cb[]" value="e4" />
                                                <label for="c44"></label>
                                            </li>
                                            <li class="{{ seat_check('e5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c45" name="cb[]" value="e5" />
                                                <label for="c45"></label>
                                            </li>
                                            <li class="{{ seat_check('e6', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c46" name="cb[]" value="e6" />
                                                <label for="c46"></label>
                                            </li>
                                            <li class="{{ seat_check('e7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c47" name="cb[]" value="e7" />
                                                <label for="c47"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('e8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c48" name="cb[]" value="e8" />
                                                <label for="c48"></label>
                                            </li>
                                            <li class="{{ seat_check('e9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c49" name="cb[]" value="e9" />
                                                <label for="c49"></label>
                                            </li>
                                            <li class="{{ seat_check('e10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c50" name="cb[]" value="e10" />
                                                <label for="c50"></label>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="st_seat_lay_row">
                                        <ul>
                                            <li class="st_seat_heading_row">F</li>
                                            <li class="{{ seat_check('f1', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c51" name="cb[]" value="f1" />
                                                <label for="c51"></label>
                                            </li>
                                            <li class="{{ seat_check('f2', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c52" name="cb[]" value="f2" />
                                                <label for="c52"></label>
                                            </li>
                                            <li class="{{ seat_check('f3', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c53" name="cb[]" value="f3" />
                                                <label for="c53"></label>
                                            </li>
                                            <li class="{{ seat_check('f4', request()->date) }} margin-left-30">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c54" name="cb[]" value="f4" />
                                                <label for="c54"></label>
                                            </li>
                                            <li class="{{ seat_check('f5', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c55" name="cb[]" value="f5" />
                                                <label for="c55"></label>
                                            </li>
                                            <li class="{{ seat_check('f6', request()->date) }}">
                                                <input type="checkbox" id="c56" name="cb[]" value="f6" />
                                                <label for="c56"></label>
                                            </li>
                                            <li class="{{ seat_check('f7', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c57" name="cb[]" value="f7" />
                                                <label for="c57"></label>
                                            </li>
                                            <li class="margin-left-30 {{ seat_check('f8', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c58" name="cb[]" value="f8" />
                                                <label for="c58"></label>
                                            </li>
                                            <li class="{{ seat_check('f9', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c59" name="cb[]" value="f9" />
                                                <label for="c59"></label>
                                            </li>
                                            <li class="{{ seat_check('f10', request()->date) }}">
                                                <span>Pay 100 TK</span>
                                                <input type="checkbox" id="c60" name="cb[]" value="f10" />
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
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.ui.min.js') }}"></script>
    {{--    <script src="{{asset("assets/frontend/movie/js/custom.js")}}"></script> --}}
    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function() {
            $('.select2').select2();
        });

        $("input[name='cb[]']").on('click', function(e) {
            var dogsSelected = $("input[name='cb[]']:checked");
            var numSelected = dogsSelected.length;
            // $('#total_amount').val(100 * numSelected)
        });

        function set_date() {
            event.preventDefault();
            var date = $('#date').val()
            window.location.href = "{{ url('admin/movie/see_available_seat') }}/" + date
        }
        $(function() {
            $("#date").datepicker({
                // Set minimum date to today
                minDate: 0,
                // dateFormat: 'yy-mm-dd' // Set the date format if needed
            });
        });
    </script>
@endpush
