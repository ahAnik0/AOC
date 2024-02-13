@extends('backend.app')
@section('title', 'Book a program')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <style nonce="{{ csp_nonce() }}">
        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }

        .css_1 {
            display: none;
        }

        .css_2 {
            overflow: no-content;
        }
        .css_3{
            margin-bottom: 10px; margin-right: 10px;
        }
    </style>
@endpush
@section('main_menu', 'Book a program')
@section('active_menu', request()->type)
@section('content')

    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="theme-form" action="{{ route('admin.hall_booking/store_event') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center" id="member_search">
                                <div class="form-group">
                                    <label class="required">Select Hall</label>
                                    <select name="hall[]" class="form-control select2" multiple="multiple" id="hall">
                                        <option value="hall_1">Hall 1 - 23000/=</option>
                                        <option value="hall_2">Hall 2 - 8625/=</option>
                                    </select>
                                    <span id="error_hall" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required">Program Date</label>
                                    <input class="form-control" type="date" name="date" id="program_date"
                                        value="{{ $selectedDate }}">
                                    <span id="error_date" class="text-danger error_field font-weight-bold"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Shift</label>
                                    <select class="form-control select2" id="shift" name="shift">
                                        <option value='' disabled selected>Select a shift</option>
                                        <option value="0">Day</option>
                                        <option value="1">Night</option>
                                    </select>
                                    <span id="error_shift" class="text-danger error_field"></span>
                                </div>

                                <div id="hide_section" class="css_1">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="col-form-label required">Select member</label>
                                            <input type="text" name="member_name" id="member_name"
                                                class="form-control input-lg"
                                                placeholder="Member name / Member ID / Ba no / Civil no / phone" autofocus
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <input type="hidden" id="member_id" name="member_id">
                                    <div id="member_list"></div>

                                    <div class="col-md-12 css_1" id="member_details">
                                        <ul class="list-group css_2">
                                            <li class="list-group-item">Ba No: <span id="member_ba_no"></span></li>
                                            <li class="list-group-item">Member Id: <span id="member_id_inputed"></span></li>
                                            <li class="list-group-item">Member Name: <span id="member_name_show"></span>
                                            </li>
                                            <li class="list-group-item">Phone: <span id="member_phone"></span></li>
                                            <li class="list-group-item">Retire status: <span id="retire"></span></li>
                                            <li class="list-group-item">Rank: <span id="rank"></span></li>
                                            <li class="list-group-item">Serving Unit: <span id="serving_unit"></span></li>
                                            <li class="list-group-item bg-warning">Status: <span id="member_status"></span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="form-group hidden_field">
                                        <label class="control-label required">Program Title</label>
                                        <input class="form-control" type="text" name="title" autocomplete="off">
                                        <span id="error_add_title" class="text-danger error_field"></span>
                                    </div>

                                    <div class="form-group hidden_field">
                                        <label class="control-label">Program Details</label>

                                        <textarea class="form-control" name="details"></textarea>
                                        <span id="error_add_details" class="text-danger error_field"></span>
                                    </div>
                                    <div class="form-group hidden_field">
                                        <label class="control-label ">Program Duration</label>
                                        <input class="form-control" type="text" name="duration" autocomplete="off">
                                        <span id="error_add_title" class="text-danger error_field"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <select name="status" class="form-control select2" id="status">
                                            <option value="" selected disabled>Please Select</option>
                                            <option value="1">Temporary (Expire after 3 days)</option>
                                            <option value="2">Due</option>
                                            <option value="3">Paid</option>
                                        </select>
                                        <span id="error_add_status" class="text-danger error_field"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="required">Payment Type</label>
                                        <select class="form-control select2" id="type" name="pay_type">
                                            <option value='' disabled selected>Select a Type</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                        </select>
                                        <span id="error_shift" class="text-danger error_field"></span>
                                    </div>
                                    <div class="form-group hidden_field">
                                        <label class="control-label">Paid Amount</label>
                                        <input class="form-control" type="number" name="amount" autocomplete="off">
                                        <span id="error_add_amount" class="text-danger error_field"></span>
                                    </div>

                                    {{--                                    <div class="form-group hidden_field"> --}}
                                    {{--                                        <label class="control-label">Mobile No</label> --}}
                                    {{--                                        <input class="form-control" type="number" name="mobile" autocomplete="off"> --}}
                                    {{--                                        <span id="error_add_amount" class="text-danger error_field"></span> --}}
                                    {{--                                    </div> --}}
                                    <div class="row justify-content-center">
                                        <button class="btn btn-primary btn-lg btn-block col-md-6 css_3" type="submit"
                                            onclick="return confirm('Are you Sure to Save !!')"
                                            id="form_submission_button"> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}" nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/select2/select2-custom.js') }}" nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.all.js') }}" nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/tooltip-init.js') }}" nonce="{{ csp_nonce() }}"></script>
    @include('backend.hall_booking.create_booking.new_booking_js')
@endpush
