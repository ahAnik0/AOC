@extends('backend.app')
@section('title','Library Booking')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .l-class {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #cdcdcd;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
        }

        .qty {
            text-align: center;
        }


        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        #dsTable td {
            text-align: center;
            vertical-align: middle;
        }

        /*.qty {*/
        /*    width: 100%%;*/
        /*}*/

        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }
        .css_1{
            display: none;
        }
        .css_2{
            overflow: 'no-content';
        }
        .css_3{
            margin-bottom:10px;
        }
        .css_4{
            margin-bottom: 1px;
        }
        .css_5{
            background:#a891ba;color:white;width: 100%;text-align: center !important;
        }
        .css_6{
            font-size: 20px;font-weight: bold;overflow: auto
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Library Booking')
@section('content')
    
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <b>Select Member</b>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Search member</label>
                                <input type="text" name="member_name" id="member_name" class="form-control input-lg"
                                       placeholder="Member name / Member ID / Ba no / Civil no / phone" autofocus/>
                            </div>
                            <input type="hidden" id="member_id" name="member_id">
                            
                            <div id="member_list">
                            </div>
                            {!! $errors->first('member_id', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="col-md-12 css_1"  id="member_details">
                            <ul class="list-group css_2" >
                                <li class="list-group-item">Member Id: <span id="member_id_inputed"></span></li>
                                <li class="list-group-item">Ba No: <span id="member_ba_no"></span></li>
                                <li class="list-group-item">Member Name: <span id="member_name_show"></span></li>
                                <li class="list-group-item">Phone: <span id="member_phone"></span></li>
                                <li class="list-group-item bg-warning">Status: <span id="member_status"></span></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="card css_3" >
                        <div class="card-body">
                            
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="input-group css_4"  >
                                            
                                            <input type="text" name="book_name" id="book_name" class="form-control input-lg" placeholder="Book name" autocomplete="off">
                                        </div>
                                        <div id="booklist"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="dsTable" class="table border">
                                        <thead>
                                        <tr class="css_5">
                                            <th>Book name</th>
                                            <th>Stock</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group css_6" >
                                                <li class="list-group-item">Quantity: <span id="total_quantity">0</span></li>
                                                <li class="list-group-item">Grand Total: <span id="grand_total">0</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-success col-md-4 m-2 " onclick="store_sales_data()" id="form_submission_button">Sale</button>
                <button class="btn btn-danger col-md-4 m-2 " onclick="location.reload();">Reload</button>
            </div>
    </div>
@include('backend.Movie.booking.cancel_booking_model')
@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    @include('backend.library.library_booking.library_booking_js')
@endpush
