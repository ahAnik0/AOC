@extends('backend.app')
@section('title','All Library Booking')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
@endpush
@section('main_menu','Library')
@section('active_menu','All Library Booking')
@section('link','')
@section('content')
    
    <div class="card">
        <div class="card-header">
            @include('backend.library.library_booking.library_booking_search')
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Member</th>
                    <th>Books</th>
                    <th>Qty</th>
                    <th>selling Amount</th>
                    <th>Total profit</th>
                    <th>Cancel Reason</th>
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
                    <th class="text-right">Total:</th>
                    <th class="bg-danger"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@include('backend.Movie.booking.cancel_booking_model')
@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable_sum.js')}}"></script>

    <script src="{{ asset('assets/backend/js/datatable/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/jszip.min.js') }}"></script>
    @include('backend.library.library_booking.all_library_booking_js')
@endpush
