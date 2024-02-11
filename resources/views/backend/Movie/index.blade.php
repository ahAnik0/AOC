@extends('backend.app')
@section('title','All Movie')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
@endpush
@section('main_menu','Movie')
@section('active_menu','All Movie')
@section('link','')
@section('content')

    <div class="card">
        <div class="card-header">
{{--        @include('backend.member.all_member_search')--}}
            <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Poster</th>
                    <th>Start Date</th>
                    <th>End date</th>
                    <th>Show Time</th>
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
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>

    <script src="{{ asset('assets/backend/js/datatable/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/jszip.min.js') }}"></script>
    @include('backend.Movie.index_js')
@endpush
