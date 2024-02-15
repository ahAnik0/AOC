@extends('backend.app')
@section('title','Book a program')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/jquery-ui.css') }}" />

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

@section('main_menu','Book a program')
@section('active_menu',request()->type)
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
        <form class="theme-form" action="{{route('admin.hall_booking/update_event')}}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center" id="member_search">
                                <div class="form-group">
                                    <label class="required">Select Hall</label>
                                    <select name="hall[]" class="form-control select2" multiple="multiple" id="hall">
                                        <option value="hall_1" {{ in_array('hall_1', (array)$event_date->hall) ? 'selected' : '' }}>Hall 1 - 23000/=</option>
                                        <option value="hall_2" {{ in_array('hall_2', (array)$event_date->hall) ? 'selected' : '' }}>Hall 2 - 8625/=</option>
                                    </select>
                                    <span id="error_hall" class="text-danger error_field"></span>
                                </div>
                                
                                <input type="hidden" name="edit_id" value="{{$event_date->id}}" id="hall_data">
                                
                                <div class="form-group hidden_field">
                                    <label class="control-label required">Program Date</label>
                                    <input class="form-control" type="text" name="date" id="program_date"
                                        value="{{$event_date->date }}">
                                    <span id="error_date" class="text-danger error_field font-weight-bold"></span>
                                </div>
                                <div class="form-group">
                                    <label class="required">Shift</label>
                                    <select class="form-control select2" id="shift" name="shift">
                                        <option value='' disabled selected>Select a shift</option>
                                        <option value="0" {{$event_date->shift == 0 ? 'selected':''}}>Day</option>
                                        <option value="1" {{$event_date->shift == 1 ? 'selected':''}}>Night</option>
                                    </select>
                                    <span id="error_shift" class="text-danger error_field"></span>
                                </div>
                                
                                <div>
                                    <div class="form-group">
                                        <label class="control-label required">Program Title</label>
                                        <input class="form-control" type="text" name="title" autocomplete="off" value="{{$event_date->title}}">
                                        <span id="error_add_title" class="text-danger error_field"></span>
                                    </div>
                                    
                                    <div class="form-group hidden_field">
                                        <label class="control-label">Program Details</label>
                                        <textarea class="form-control" name="details">{{$event_date->details}}</textarea>
                                        <span id="error_add_details" class="text-danger error_field"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <select name="status" class="form-control select2" id="status">
                                            <option value="" selected disabled>Please Select</option>
                                            <option value="1" {{$event_date->status == 1 ? 'selected':''}}>Temporary (Expire after 3 days)</option>
                                            <option value="2" {{$event_date->status == 2 ? 'selected':''}}>Due</option>
                                            <option value="3" {{$event_date->status == 3 ? 'selected':''}}>Paid</option>
                                        </select>
                                        <span id="error_add_status" class="text-danger error_field"></span>
                                    </div>
                                    
                                    <div class="form-group hidden_field">
                                        <label class="control-label">Paid Amount</label>
                                        <input class="form-control" type="number" name="amount" autocomplete="off" value="{{$event_date->amount}}">
                                        <span id="error_add_amount" class="text-danger error_field"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary btn-lg btn-block col-md-6 css_1" type="submit"  id="form_submission_button">Update
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
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    <script src="{{ asset('assets/backend/js/jquery.ui.min.js') }}"></script>

    @include('backend.hall_booking.edit_booking.edit_booking_js')
@endpush
