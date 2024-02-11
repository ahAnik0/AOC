@extends('backend.app')
@section('title', 'Additional Charge of a program')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <style  nonce="{{ csp_nonce() }}">
        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }
        .css_1{
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
        <form class="theme-form" action="{{ route('admin.hall_booking/store_charge_event') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center" id="member_search">
                                <div class="form-group">
                                    <label class="control-label required">Hall Rent</label>
                                    <input class="form-control" type="number" id="hall_rent" name="hall_rent" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->hall_rent : ''}}">
                                        
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>

                                <input type="hidden" name="booking_id" value="{{ $event_date->id }}" id="hall_data">
                                <input type="hidden" name="chrg_id" value="{{!empty($charge) ? $charge->id : ''}}" >

                                <div class="form-group">
                                    <label class="control-label ">Hall Rent Vat(15%)</label>
                                    <input class="form-control" type="number" name="hall_vat" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->hall_vat : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Current Bill</label>
                                    <input class="form-control" type="number" name="current_bill" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->current_bill : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Cookeries Bill</label>
                                    <input class="form-control" type="number" name="cookeries_bill" autocomplete="off"
                                        value=" {{!empty($charge) ? $charge->cookeries_bill : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Cook House Bill</label>
                                    <input class="form-control" type="number" name="cook_house_bill" autocomplete="off"
                                        value="{{!empty($charge) ?  $charge->cook_house_bill : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Event Charge</label>
                                    <input class="form-control" type="number" name="event_charge" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->event_charge : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Event Vat(15%)</label>
                                    <input class="form-control" type="number" name="event_vat" autocomplete="off"
                                        value="{{!empty($charge) ?  $charge->event_vat : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Catering Bill</label>
                                    <input class="form-control" type="number" name="catering_bill" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->catering_bill : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Catering Vat(15%)</label>
                                    <input class="form-control" type="number" name="catering_bill_vat" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->catering_bill_vat : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Cookeries Damage</label>
                                    <input class="form-control" type="number" name="damage_bill" autocomplete="off"
                                        value="{{!empty($charge) ? $charge->damage_bill : ''}}">
                                    <span id="error_add_title" class="text-danger error_field"></span>
                                </div>
                            


                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary btn-lg btn-block col-md-6 css_1" type="submit"
                                     id="form_submission_button">Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/backend/js/tooltip-init.js') }}"></script>
    @include('backend.hall_booking.edit_booking.edit_booking_js')
@endpush
