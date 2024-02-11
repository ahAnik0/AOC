@extends('backend.app')
@section('title','Edit relational member')
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
        .css_1{
            text-transform:uppercase;
        }
        .css_2{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Edit relational member')
@section('content')

    <div class="container-fluid">
        <form id="save_info" class="theme-form">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="text" id="member_id_inputed_hidden" hidden value="{{$member->parent_member->member_id_inputed}}">
                                <input type="text" id="ba_no_hidden" hidden value="{{$member->parent_member->ba_no}}">
                                <input type="text" id="parent_member_id" name="parent_member_id" hidden value="{{$member->parent_member_id}}">

                                <div class="form-group">
                                    <label class="control-label required">Parent member ID</label>
                                    <input class="form-control disabled" type="text" name="parent_member_id" autocomplete="off" value="{{$member->parent_member_id}}">
                                    <span id="error_parent_member_id" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Full Name</label>
                                    <input class="form-control" type="text" name="fullname" autocomplete="off" value="{{$member->fullname}}">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required">Member ID</label>
                                    <input class="form-control disabled" type="text" name="member_id_inputed" id="member_id_inputed" autocomplete="off" value="{{$member->member_id_inputed}}">
                                    <span id="error_member_id_inputed" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="control-label required" id="ba_no_label">Ba No</label>
                                    <input class="form-control disabled css_1" type="text" name="ba_no" id="ba_no" autocomplete="off"
                                           value="{{$member->ba_no}}">
                                    <span id="error_ba_no" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group army_hidden_field">
                                    <label>Relationship</label>
                                    <select name="relationship_id" id="relationship_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($relationship as   $data)
                                            <option value="{{$data->id}}" {{$member->relationship_id == $data->id?"selected":''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_relationship_id" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="required">Blood Group</label>
                                    <select name="blood_group_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($blood_groups as   $data)
                                            <option value="{{$data->id}}" {{$member->blood_group_id == $data->id?"selected":''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_blood_group_id" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Date of birth</label>
                                    <input class="form-control" type="date" name="dob" value="{{$member->dob}}">
                                    <span id="error_dob" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">RFID</label>
                                    <input class="form-control" type="text" name="rfid" autocomplete="off" id="rfid" value="{{$member->rfid}}">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Parent Member Type</label>
                                    <select name="member_type" class="form-control disabled" id="member_type">
                                        <option value="" selected>Please Select</option>
                                        <option value="1" {{$member->parent_member->member_type == 1 ?"selected":''}}>BA NO</option>
                                        <option value="2" {{$member->parent_member->member_type == 2 ?"selected":''}}>TSS</option>
                                        <option value="3" {{$member->parent_member->member_type == 3 ?"selected":''}}>Civil No</option>
                                    </select>
                                    <span id="error_member_type" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group hidden_field">
                                    <label class="required">Serving Unit</label>
                                    <select name="service_unit_id" id="service_unit_id" class="form-control disabled">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($serving_units as $data)
                                            <option value="{{$data->id}}" {{$member->parent_member->service_unit_id == $data->id ? "selected":''}} readonly>{{$data->name}}</option>
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
                                            <option value="{{$data->id}}" {{$member->parent_member->designation_id == $data->id?"selected":''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_designation_id" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label>Is Retired</label>
                                    <select name="isRetired" id="isRetired" class="form-control disabled">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1" {{$member->parent_member->isRetired = '1' ?"selected":''}}>Retired</option>
                                        <option value="0" {{$member->parent_member->isRetired = '0' ?"selected":''}}>Not Retired</option>
                                    </select>
                                    <span id="error_isRetired" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" autocomplete="off" value="{{$member->phone}}">
                                    <span id="error_phone" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Emergency Contact</label>
                                    <input class="form-control" type="text" name="emergency_contact_no" id="emergency_contact_no" autocomplete="off"
                                           value="{{$member->emergency_contact_no}}">
                                    <span id="error_emergency_contact_no" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" autocomplete="off" value="{{$member->email}}">
                                    <span id="error_email" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Address</label>
                                    <input class="form-control" type="text" name="address" id="address" autocomplete="off" value="{{$member->address}}">
                                    <span id="error_address" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="required">Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1" {{$member->status = '1' ?"selected":''}}>Active</option>
                                        <option value="0" {{$member->status = '0' ?"selected":''}}>Inactive</option>
                                    </select>
                                    <span id="error_status" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Issue Date</label>
                                    <input class="form-control" type="date" name="issue_date" id="issue_date" value="{{$member->issue_date}}">
                                    <span id="error_issue_date" class="text-danger error_field"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">Expire Date</label>
                                    <input class="form-control" type="date" name="expire_date" id="expire_date" value="{{$member->expire_date}}">
                                    <span id="error_expire_date" class="text-danger error_field"></span>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6 css_2" type="submit"  id="form_submission_button">Save and Continue
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
    @include('backend.member.relational_member.edit_relational_member_js')
@endpush
