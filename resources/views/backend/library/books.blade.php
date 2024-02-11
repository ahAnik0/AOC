@extends('backend.app')
@section('title','Books')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            margin-left: 80%;
        }
    </style>
@endpush
@section('main_menu','Books')
@section('active_menu','Books')
@section('link','')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col-6">
                    <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
                </div>
                <div class="col-6">
                    <a data-bs-toggle="modal" data-bs-target="#add_model" type="button" class="btn-sm btn-success css_1" >Add @yield('title')</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Book/Item name</th>
                    <th>Author</th>
                    <th>Buying price</th>
                    <th>selling price</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
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
                    <th class="bg-danger"></th>
                    <th class="bg-danger"></th>
                    <th class="bg-danger"></th>
                    <th class="bg-danger"></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    @include('backend.library.add_model')
    @include('backend.library.edit_model')

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable_sum.js')}}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
    @include('backend.library.book_js')
@endpush
