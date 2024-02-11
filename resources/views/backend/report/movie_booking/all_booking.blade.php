@extends('backend.app')
@section('title','Movie Booking History')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
    </style>
@endpush
@section('main_menu','Booking')
@section('active_menu','Movie Booking History')
@section('link','')
@section('content')

    <div class="card">
        <div class="card-header">
            @include('backend.report.movie_booking.booking_search')
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Member name</th>
                    <th>Member Type</th>
                    <th>Movie Name</th>
                    <th>Booked Seat</th>
                    <th>Amount</th>
                    <th>Booking Date</th>
                    <th>Reason</th>
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
                    <th class="text-right">Total:</th>
                    <th class="bg-danger"></th>
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
    @include('backend.report.movie_booking.all_booking_js')
@endpush
