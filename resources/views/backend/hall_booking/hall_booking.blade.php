@extends('backend.app')
@section('title','Event')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}"  >
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}"  >
    <style  nonce="{{ csp_nonce() }}">
        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }
        #stl_1{
            text-align:right;
        }
        #stl_2{
        width: 700px;
    }
        #member_details{
            display: none;
        }
        #stl_3{
            overflow: no-content;
        }
        #stl_5{
        overflow: no-content;
    }
    </style>
@endpush

@section('main_menu','Event')
@section('active_menu','Serving Unit')
@section('link','')
@section('content')
@if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
 @endif
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
 @endif
    <div class="card overflow-x-scroll">
        <div class="card-header">
            @include('backend.hall_booking.hall_booking_search')
            <div class="row justify-content-between align-items-center">
                <div class="col-6">
                    <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
                </div>
{{--                <div class="col-6">--}}
{{--                    <a data-bs-toggle="modal" data-bs-target="#add_model" type="button" class="btn-sm btn-success" style="margin-left: 80%">Add new Client</a>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="card-bod">
            <table class="table table-bordered yajra-datatable" >
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Ba No</th>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Booking Date</th>
                    <th>Event Date</th>
                    <th>Hall</th>
                    <th>Amount Paid</th>
                    <th>Shift</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th id="stl_1">Total:</th>
                    <th></th>
                    <th class="bg-danger"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    @include('backend.hall_booking.add_model')
    @include('backend.hall_booking.edit_model')

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js')}}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{asset('assets/backend/js/datatable_sum.js')}}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"  nonce="{{ csp_nonce() }}"></script>

    <script src="{{ asset('assets/backend/js/datatable/datatables/datatables.buttons.min.js') }}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.html5.min.js') }}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.print.min.js') }}"  nonce="{{ csp_nonce() }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/jszip.min.js') }}"  nonce="{{ csp_nonce() }}"></script>
    
    @include('backend.hall_booking.hall_booking_js')
@endpush
