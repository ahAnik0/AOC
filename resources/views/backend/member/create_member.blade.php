@extends('backend.app')
@section('title','Create member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            font-weight: bold;
        }
        .css_2{
            text-transform:uppercase;
        }
        .css_3{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Create member')
@section('content')

    <div class="container-fluid">
        <form id="save_info" class="theme-form">
            @csrf
            <div class="row">
                <div class="form-builder-header-1 mb-4">
                    <ul class="nav nav-primary" id="formtabs">
                        <li class="nav-item"><a href="{{route('admin.member/create_member')}}" class="nav-link m-r-5 active btn css_1" >For Officer member</a>
                        </li>
                        <li class="nav-item"><a href="{{route('admin.member/create_relational_member')}}" class="nav-link m-r-5 btn css_1" >For Relational member</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="required">Member Type</label>
                                    <select name="member_type" class="form-control select2" id="member_type">
                                        <option value="">Please Select</option>
                                        <option value="1">BA NO (Army)</option>
                                        <option value="2">TSS (Retired)</option>
                                        <option value="3">Civil No (Civil)</option>
                                    </select>
                                    <span id="error_member_type" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Privilege</label>
                                    <select name="privilege[]" class="form-control select2" multiple="multiple" id="privilege">
                                        <option value="1">Cineplex</option>
                                        <option value="2">Bowling</option>
                                        <option value="3">Library</option>
                                        <option value="4">Swimming Pool</option>
                                        <option value="5">Tennis</option>
                                    </select>
                                    <span id="error_privilege" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required" id="ba_no_label">Ba No</label>
                                    <input class="form-control css_2" type="text" name="ba_no" autocomplete="off" >
                                    <span id="error_ba_no" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required">Member ID</label>
                                    <input class="form-control" type="text" name="member_id_inputed" autocomplete="off">
                                    <span id="error_member_id_inputed" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="required">Serving Unit</label>
                                    <select name="service_unit_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($serving_units as   $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_service_unit_id" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Full Name</label>
                                    <input class="form-control" type="text" name="fullname" autocomplete="off">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Rank/Designation</label>
                                    <select name="designation_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($ranks as   $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_designation_id" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label>Is Retired</label>
                                    <select name="isRetired" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1">Retired</option>
                                        <option value="0">Not Retired</option>
                                    </select>
                                    <span id="error_isRetired" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Phone</label>
                                    <input class="form-control" type="text" name="phone" autocomplete="off">
                                    <span id="error_phone" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Emergency Contact</label>
                                    <input class="form-control" type="text" name="emergency_contact_no" autocomplete="off">
                                    <span id="error_emergency_contact_no" class="text-danger error_field"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group">
                                    <label class="control-label required">Email (Must be Unique)</label>
                                    <input class="form-control" type="email" name="email" autocomplete="off">
                                    <span id="error_email" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Address</label>
                                    <input class="form-control" type="text" name="address" autocomplete="off">
                                    <span id="error_address" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Date of birth</label>
                                    <input class="form-control" type="date" name="dob">
                                    <span id="error_dob" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="required">Blood Group</label>
                                    <select name="blood_group_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($blood_groups as   $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_blood_group_id" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Status</label>
                                    <select name="status" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span id="error_status" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">RFID</label>
                                    <input class="form-control" type="text" name="rfid" autocomplete="off">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label">RFID2 (Combo card)</label>
                                    <input class="form-control" type="text" name="rfid2" autocomplete="off">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Issue Date</label>
                                    <input class="form-control" type="date" name="issue_date">
                                    <span id="error_issue_date" class="text-danger error_field"></span>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label">Expire Date</label>--}}
{{--                                    <input class="form-control" type="date" name="expire_date">--}}
{{--                                    <span id="error_expire_date" class="text-danger error_field"></span>--}}
{{--                                </div>--}}
                                
                                <div class="form-group">
                                    <label class="control-label required">Last Payment Date (লাস্ট কবে পেমেন্ট করছে?)</label>
                                    <input class="form-control" type="date" name="connection_to">
                                    <span id="error_connection_to" class="text-danger error_field"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6 css_3" type="submit"  id="form_submission_button">Save and Continue
                </button>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    @include('backend.member.create_member_js')
@endpush
