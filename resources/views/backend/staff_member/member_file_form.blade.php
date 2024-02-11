@extends('backend.app')
@section('title','Create member')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            width: 0%;
        }
        .css_2{
            margin-bottom: 10px; margin-right: 10px;
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Upload Photos & other file')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="required">Please Enclose 1* Passport Size Photograph (own) (Width= 300px and Height= 300px,PNG,JPG, Max:2mb):</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.member/passport_photo_upload') }}" enctype="multipart/form-data" id="photograph_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="file" name="file" id="file" class="form-control"/>
                                    </div>
                                </div>
                                <input type="submit" name="upload" value="Upload" class="btn btn-sm btn-success btn-block col-md-2"/>
                            </div>
                            <div class="progress mt-2">
                                <div class="progress-bar css_1" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                    0%
                                </div>
                            </div>
                            <div id="success"></div>
                            <span id="error_photograph_file_name" class="text-danger error_field"></span>
                            <span id="photograph_file_name"></span>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="required">Signature (Width= 300px and Height= 80px,PNG,JPG, Max:2mb):</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.member/signature_upload') }}" enctype="multipart/form-data" id="sig_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="file" name="file" id="file" class="form-control"/>
                                    </div>
                                </div>
                                <input type="submit" name="upload" value="Upload" class="btn btn-sm btn-success btn-block col-md-2"/>
                            </div>
                            <div class="progress mt-2">
                                <div class="progress-bar css_1" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                    0%
                                </div>
                            </div>
                            <div id="success"></div>
                            <span id="sign_file_name"></span>
                        </form>
                        <span id="error_sign_file_name" class="text-danger error_field"></span>
                    </div>
                </div>

{{--                @if($member_type == 1)--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header pb-0">--}}
{{--                            <h5 class="required">Qr Code (PNG,JPG, Max:2mb):</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <form method="post" action="{{ route('admin.member/qr_code_upload') }}" enctype="multipart/form-data" id="qr_code_form">--}}
{{--                                @csrf--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-10">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="file" name="file" id="file" class="form-control"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <input type="submit" name="upload" value="Upload" class="btn btn-sm btn-success btn-block col-md-2"/>--}}
{{--                                </div>--}}
{{--                                <div class="progress mt-2">--}}
{{--                                    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">--}}
{{--                                        0%--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div id="success"></div>--}}
{{--                                <span id="qr_code_file_name"></span>--}}
{{--                            </form>--}}
{{--                            <span id="error_qr_code_file_name" class="text-danger error_field"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

            </div>

            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-6 css_2" type="button"  id="form_submission_button"
                        onclick="submit_other_document()">Save
                </button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.form.min.js')}}"></script>
    @include('backend.member.member_file_form_js')
@endpush
