@extends('backend.app')
@section('title','Edit member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
@endpush
@section('main_menu','Home')
@section('active_menu','Edit member')
@section('content')
    
    <div class="container-fluid">
        <form id="save_info" class="theme-form">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="required">Member Type</label>
                                    <select name="member_type" class="form-control select2" id="member_type">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1" {{$member->member_type == 1 ?"selected":''}}>BA NO</option>
                                        <option value="2" {{$member->member_type == 2 ?"selected":''}}>TSS</option>
                                        <option value="3" {{$member->member_type == 3 ?"selected":''}}>Civil No</option>
                                    </select>
                                    <span id="error_member_type" class="text-danger error_field"></span>
                                </div>
                                
                                <input type="hidden" value="{{$member->privilege}}" id="privilage_data">
                                
                                
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
                                    <label class="control-label required" id="ba_no_label">Ba No / Tss No / Civil No</label>
                                    <input class="form-control" type="text" name="ba_no" value="{{$member->ba_no}}">
                                    <span id="error_ba_no" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group hidden_field">
                                    <label class="control-label required">Member ID</label>
                                    <input class="form-control" type="text" name="member_id_inputed" value="{{$member->member_id_inputed}}">
                                    <span id="error_member_id_inputed" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group hidden_field">
                                    <label class="control-label required">Badge Number</label>
                                    <input class="form-control" type="text" name="badge_number" value="{{$member->badge_number}}">
                                    <span id="error_badge_number" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group hidden_field">
                                    <label class="required">Serving Unit</label>
                                    <select name="service_unit_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($serving_units as   $data)
                                            <option value="{{$data->id}}" {{$member->service_unit_id == $data->id?"selected":''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_service_unit_id" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Full Name</label>
                                    <input class="form-control" type="text" name="fullname" value="{{$member->fullname}}">
                                    <span id="error_fullname" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="required">Rank/Designation</label>
                                    <select name="designation_id" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($ranks as   $data)
                                            <option value="{{$data->id}}" {{$member->designation_id == $data->id?"selected":''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_designation_id" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Is Retired</label>
                                    <select name="isRetired" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1" {{$member->isRetired = '1' ?"selected":''}}>Retired</option>
                                        <option value="0" {{$member->isRetired = '0' ?"selected":''}}>Not Retired</option>
                                    </select>
                                    <span id="error_isRetired" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">Phone</label>
                                    <input class="form-control" type="text" name="phone" value="{{$member->phone}}">
                                    <span id="error_phone" class="text-danger error_field"></span>
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
                                    <label class="control-label">Emergency Contact</label>
                                    <input class="form-control" type="text" name="emergency_contact_no" value="{{$member->emergency_contact_no}}">
                                    <span id="error_emergency_contact_no" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$member->email}}">
                                    <span id="error_email" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">Address</label>
                                    <input class="form-control" type="text" name="address" value="{{$member->address}}">
                                    <span id="error_address" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">Date of birth</label>
                                    <input class="form-control" type="date" name="dob" value="{{$member->dob}}">
                                    <span id="error_dob" class="text-danger error_field"></span>
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
                                    <label class="required">Status</label>
                                    <select name="status" class="form-control select2">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="1" {{$member->status == '1' ? "selected":''}}>Active</option>
                                        <option value="0" {{$member->status == '0' ? "selected":''}}>Inactive</option>
                                    </select>
                                    <span id="error_status" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">RFID</label>
                                    <input class="form-control" type="text" name="rfid" value="{{$member->rfid}}">
                                    <span id="error_rfid" class="text-danger error_field"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">RFID2 ( Combo Id card)</label>
                                    <input class="form-control" type="text" name="rfid2" value="{{$member->rfid2}}">
                                    <span id="error_rfid2" class="text-danger error_field"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">Issue Date</label>
                                    <input class="form-control" type="date" name="issue_date" value="{{$member->issue_date}}">
                                    <span id="error_issue_date" class="text-danger error_field"></span>
                                </div>
                                
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label required">Expire Date</label>--}}
{{--                                    <input class="form-control" type="date" name="expire_date" value="{{$member->expire_date}}">--}}
{{--                                    <span id="error_expire_date" class="text-danger error_field"></span>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label class="control-label required">Last Payment Date (লাস্ট কবে পেমেন্ট করছে?)</label>
                                    <input class="form-control" type="date" name="connection_to" value="{{$member->connection_to}}">
                                    <span id="error_connection_to" class="text-danger error_field"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6" type="submit" style="margin-bottom: 10px;margin-right: 10px" id="form_submission_button">Update and
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
    @include('backend.member.edit_member.edit_member_js')
@endpush
