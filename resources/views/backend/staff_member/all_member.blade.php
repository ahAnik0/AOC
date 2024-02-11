@extends('backend.app')
@section('title','All Staff')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
@endpush
@section('main_menu','Staff')
@section('active_menu','All Staff')
@section('link','')
@section('content')

    <div class="card">
        <div class="card-header">
{{--            @include('backend.member.all_member_search')--}}
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th></th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Appointment</th>
                    <th>Issue date</th>
                    <th>Expire date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable_sum.js')}}"></script>
    @include('backend.staff_member.all_member_js')
@endpush
