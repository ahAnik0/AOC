@extends('backend.app')
@section('title','Create Staff member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Create Staff member')
@section('content')
    
    <div class="container-fluid">
        <form id="save_info" class="theme-form" action="{{route('admin.staffmember/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{old('name')}}">
                                {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
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
                                {!! $errors->first('privilege', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">NID Number</label>
                                <input class="form-control" type="text" id="nid" name="nid"
                                       value="{{old('nid')}}">
                                {!! $errors->first('nid', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Date of Bir</label>
                                <input class="form-control digits" type="date" id="dob" name="dob"
                                       value="{{old('dob')}}">
                                {!! $errors->first('dob', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Phone</label>
                                <input class="form-control" type="text" id="phone" name="phone"
                                       value="{{old('phone')}}">
                                {!! $errors->first('phone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Address</label>
                                <input class="form-control" type="text" id="address" name="address"
                                       value="{{old('address')}}">
                                {!! $errors->first('address', '<p class="help-block text-danger">:message</p>') !!}
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
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Appointment</label>
                                <input class="form-control" type="text" id="appointment" name="appointment"
                                       value="{{old('appointment')}}">
                                {!! $errors->first('appointment', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">RFID</label>
                                <input class="form-control" type="text" id="rfid" name="rfid"
                                       value="{{old('rfid')}}">
                                {!! $errors->first('rfid', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Issue Date</label>
                                <input class="form-control digits" type="date" id="issue_date" name="issue_date"
                                       value="{{old('issue_date')}}">
                                {!! $errors->first('issue_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Expire Date</label>
                                <input class="form-control digits" type="date" id="expire_date" name="expire_date"
                                       value="{{old('expire_date')}}">
                                {!! $errors->first('expire_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">For Picture Upload</label>
                                <input class="form-control" type="file" aria-label="file example" name="photo">
                                {!! $errors->first('photo', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">For Signature Upload</label>
                                <input class="form-control" type="file" aria-label="file example" name="signature">
                                {!! $errors->first('signature', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6 css-1" type="submit"  id="form_submission_button">Save
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
    @include('backend.staff_member.create_member_js')
@endpush
