@extends('backend.app')
@section('title','Create relational member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .search_area {
            display: flex;
            align-items: center;
        }

        .disabled {
            pointer-events: none;
            background-color: #000;
            color: white !important;
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Create relational member')
@section('content')

    <div class="container-fluid">
        <form id="save_info" class="theme-form">
            @csrf
            <div class="row">
                <div class="form-builder-header-1 mb-4">
                    <ul class="nav nav-primary" id="formtabs">
                        <li class="nav-item"><a href="{{route('admin.member/create_member')}}" class="nav-link m-r-5 btn fw-bold" >For Officer member</a></li>
                        <li class="nav-item"><a href="{{route('admin.member/create_relational_member')}}" class="nav-link active m-r-5 btn fw-bold">For Relational member</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="col-md-10">
                                        <label class="control-label required" id="ba_no_label">Search Parent member ID</label>
                                        <input class="form-control" type="text" name="search_member_id" id="search_member_id" autocomplete="off"></div>
                                    <div class="col-md-2">
                                        <button class="btn btn-block btn-secondary mt-4" id="member_id_search_button">Search</button>
                                    </div>
                                </div>
                                <hr>

                                <input type="text" id="member_id_inputed_hidden" hidden>
                                <input type="text" id="ba_no_hidden" hidden>
                                <input type="text" id="parent_member_id" name="parent_member_id" hidden>

                                <div class="form-group">
                                    <label class="control-label required">Full Name</label>
                                    <input class="form-control" type="text" name="fullname" autocomplete="off">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required">Member ID</label>
                                    <input class="form-control disabled" type="text" name="member_id_inputed" id="member_id_inputed" autocomplete="off">
                                    <span id="error_member_id_inputed" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required" id="ba_no_label">Ba No</label>
                                    <input class="form-control disabled text-uppercase" type="text" name="ba_no" id="ba_no" autocomplete="off" 
                                    >
                                    <span id="error_ba_no" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group army_hidden_field">
                                    <label>Relationship</label>
                                    <select name="relationship_id" id="relationship_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($relationship as   $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_relationship_id" class="text-danger error_field"></span>
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
                                    <label class="control-label required">Date of birth</label>
                                    <input class="form-control" type="date" name="dob">
                                    <span id="error_dob" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">RFID</label>
                                    <input class="form-control" type="text" name="rfid" autocomplete="off" id="rfid">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Member Type</label>
                                    <select name="member_type" class="form-control disabled" id="member_type">
                                        <option value="" selected>Please Select</option>
                                        <option value="1">BA NO</option>
                                        <option value="2">TSS</option>
                                        <option value="3">Civil No</option>
                                    </select>
                                    <span id="error_member_type" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="required">Serving Unit</label>
                                    <select name="service_unit_id" id="service_unit_id" class="form-control disabled">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($serving_units as   $data)
                                            <option value="{{$data->id}}" readonly>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_service_unit_id" class="text-danger error_field"></span>
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
                                    <label class="required">Rank/Designation</label>
                                    <select name="designation_id" id="designation_id" class="form-control disabled">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($ranks as   $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_designation_id" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label>Is Retired</label>
                                    <select name="isRetired" id="isRetired" class="form-control disabled">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1">Retired</option>
                                        <option value="0">Not Retired</option>
                                    </select>
                                    <span id="error_isRetired" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" autocomplete="off">
                                    <span id="error_phone" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Emergency Contact</label>
                                    <input class="form-control" type="text" name="emergency_contact_no" id="emergency_contact_no" autocomplete="off">
                                    <span id="error_emergency_contact_no" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" autocomplete="off">
                                    <span id="error_email" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Address</label>
                                    <input class="form-control" type="text" name="address" id="address" autocomplete="off">
                                    <span id="error_address" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span id="error_status" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Issue Date</label>
                                    <input class="form-control" type="date" name="issue_date" id="issue_date">
                                    <span id="error_issue_date" class="text-danger error_field"></span>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label required">Expire Date</label>--}}
{{--                                    <input class="form-control" type="date" name="expire_date" id="expire_date">--}}
{{--                                    <span id="error_expire_date" class="text-danger error_field"></span>--}}
{{--                                </div>--}}
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6" type="submit" style="margin-bottom: 10px;margin-right: 10px" id="form_submission_button">Save and
                    Continue
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
    @include('backend.member.relational_member.create_relational_member_js')
@endpush
