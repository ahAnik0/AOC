@extends('backend.app')
@section('title','Payment History')
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
@section('active_menu','Payment History')
@section('link','')
@section('content')
    
    <div class="card">
        <div class="card-header">
            @include('backend.report.payment history.payment_history_search')
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Payment for</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="text-right">Total:</th>
                    <th class="bg-danger"></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

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
    @include('backend.report.payment history.payment_history_js')
@endpush
