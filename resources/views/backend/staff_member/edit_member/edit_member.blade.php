@extends('backend.app')
@section('title','Edit staff member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
        height:50px;margin-top:20px

        }
        .css_2{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Edit staff member')
@section('content')

       <div class="container-fluid">
        <form id="save_info" class="theme-form" action="{{route('admin.staffmember/update',$member->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{$member->name}}">
                                {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
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
                                {!! $errors->first('privilege', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">NID Number</label>
                                <input class="form-control" type="text" id="nid" name="nid"
                                       value="{{$member->nid}}">
                                {!! $errors->first('nid', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Date of Bir</label>
                                <input class="form-control digits" type="date" id="dob" name="dob"
                                       value="{{$member->dob}}">
                                {!! $errors->first('dob', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Phone</label>
                                <input class="form-control" type="text" id="phone" name="phone"
                                       value="{{$member->phone}}">
                                {!! $errors->first('phone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Address</label>
                                <input class="form-control" type="text" id="address" name="address"
                                       value="{{$member->address}}">
                                {!! $errors->first('address', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                <label class="required">Status</label>
                                <select name="status" class="form-control select2">
                                    <option value="" selected disabled>Please Select</option>
                                    <option value="1" {{$member->status == 1? "selected":''}}>Active</option>
                                    <option value="0" {{$member->status == 0? "selected":''}}>Inactive</option>
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
                                       value="{{$member->appointment}}">
                                {!! $errors->first('appointment', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">RFID</label>
                                <input class="form-control" type="text" id="rfid" name="rfid"
                                       value="{{$member->rfid}}">
                                {!! $errors->first('rfid', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Issue Date</label>
                                <input class="form-control digits" type="date" id="issue_date" name="issue_date"
                                       value="{{$member->issue_date}}">
                                {!! $errors->first('issue_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">Expire Date</label>
                                <input class="form-control digits" type="date" id="expire_date" name="expire_date"
                                       value="{{$member->expire_date}}">
                                {!! $errors->first('expire_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">For Picture Upload</label>
                                <input class="form-control" type="file" aria-label="file example" name="photo">
                                <img src="{{asset("uploads/staff_img/".$member->photo)}}" class="img-thumbnail css_1" />
                                {!! $errors->first('photo', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label required">For Signature Upload</label>
                                <input class="form-control" type="file" aria-label="file example" name="signature">
                                <img src="{{asset("uploads/staff_img/".$member->signature)}}" class="img-thumbnail css_1" />
                                {!! $errors->first('signature', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6 css_2" type="submit"  id="form_submission_button">Update
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
    @include('backend.staff_member.edit_member.edit_member_js')
@endpush
