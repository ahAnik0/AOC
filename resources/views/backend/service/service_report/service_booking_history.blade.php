@extends('backend.app')
@section('title', 'service Report')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables.css') }}">
    
    <style  nonce="{{ csp_nonce() }}">
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .disabled {
            pointer-events: none;
            background-color: #000;
            color: white !important;
        }
    </style>
@endpush
@section('main_menu', 'Booking')
@section('active_menu', 'service Report')
@section('link', '')
@section('content')

    <div class="card">
        <div class="card-header">
            @include('backend.service.service_report.service_booking_history_search')
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        {{-- <a href="{{ route('pdf-show') }}"><button>Pdf</button></a> --}}
        <div class="card-body">
            <table class="table table-bordered yajra-datatable" id="">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Service Name</th>
                        <th>Member name</th>
                        <th>Number Of member</th>
                        <th>Guest member</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Cancel reason</th>
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
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable_sum.js') }}"></script>

    <script src="{{ asset('assets/backend/js/datatable/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/jszip.min.js') }}"></script>


    @include('backend.service.service_report.service_booking_history_js')
@endpush
