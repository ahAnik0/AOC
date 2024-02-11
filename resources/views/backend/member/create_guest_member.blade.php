@extends('backend.app')
@section('title','Create Guest member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Create Guest member')
@section('content')
    
    <div class="container-fluid">
        <form id="save_info" class="theme-form" action="{{route('admin.member/submit_guest_from')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Name</label>
                                <input class="form-control" type="text" id="fullname" name="fullname"
                                       value="{{old('fullname')}}">
                                {!! $errors->first('fullname', '<p class="help-block text-danger">:message</p>') !!}
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
                                <label class="col-form-label required">Email Phone</label>
                                <input class="form-control" type="email" id="email" name="email"
                                       value="{{old('email')}}">
                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-4 css_1" type="submit"  id="form_submission_button">Save
                </button>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
    <script  nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
