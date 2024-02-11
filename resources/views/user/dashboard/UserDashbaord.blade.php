@extends('user.app')
@section('title', 'user Dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/datatables.css')}}">
    <style  nonce="{{ csp_nonce() }}">
    .css1{
        width: 100%;
    }
    </style>
@endpush
@section('main_menu', 'Home')
@section('active_menu', 'user Dashboard')
@section('link', route('user.userdashboard'))
@section('content')
    <div class="row">
        @if(!check_user_data_valid(user_id()))
            <div class="alert alert-danger" role="alert">
                <h5>আপনার ইনফরমেশন সার্ভার এ আপডেট নয়। তথ্য আপডেট করতে যোগাযোগ করুন : +8801718181416</h5>
            </div>
        @else
            <div class="row justify-content-center mb-3">
                <div class="col-md-12">
                    <a href="{{route('user.pay_bill')}}" class="btn btn-lg btn-block btn-danger" class="css1">Pay your monthly payment</a>
                </div>
            </div>
            <br>
            <br>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Payment History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Payment Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment For</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payment_history as $key=>$data)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{\Illuminate\Support\Carbon::parse($data->created_at)->format('M d, Y')}}</td>
                                        <td>{{$data->credit}}</td>
                                        <td>{{$data->type}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Movie Booking History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-3">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Total Seat</th>
                                    <th scope="col">Ticket Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($movie_booking as $key=>$data)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{\Illuminate\Support\Carbon::parse($data->date)->format('M d, Y')}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$data->seat->count()}}</td>
                                        <td>
                                            @if($data->date > now())
                                                <a href="{{route('user.dowmload_movie_ticket',$data->id)}}" class="btn btn-success btn-sm">Download</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Service Booking History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Service For</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_history as $key=>$data)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{\Illuminate\Support\Carbon::parse($data->created_at)->format('M d, Y')}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$data->service_name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Library booking History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-4">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Total Books</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($library_booking as $key=>$data)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{\Illuminate\Support\Carbon::parse($data->created_at)->format('M d, Y')}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$data->quantity}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        @endif
    </div>





@endsection
@push('js')
    <script src="{{asset('assets/backend/js/datatable/datatables/plugin/datatables.min.js')}}"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        $(document).ready(function () {
            $('#basic-1').DataTable();
            $('#basic-2').DataTable();
            $('#basic-3').DataTable();
            $('#basic-4').DataTable();
        });
    </script>


@endpush
