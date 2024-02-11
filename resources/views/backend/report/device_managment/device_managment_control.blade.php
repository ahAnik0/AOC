@extends('backend.app')
@section('title','Member assign device')
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
@section('active_menu','Member assign device')
@section('link','')
@section('content')
   
    <div class="card">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} 
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <form action="{{route('admin.attendance/member_assign_device_delete')}}" method="get" id="search_form">
                        <div class="row p-3">
                            
                            <div class="col-4">
                                <h2>Delete Assaign List</h2>
                                <label>Devices</label>
                                <select id="device_id" class="form-control select2" name="device_id" required>
                                    <option value="" selected>Please Select</option>
                                    @foreach(\App\Models\DeviceModel::all() as $data)
                                    <option value="{{$data->id}}">{{$data->device_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-danger col-md-3" type="submit" onclick="return confirm('Are you Sure to Delete !!')">Delete</button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <form action="{{route('admin.attendance/member_assign_device_reload')}}" method="get" id="search_form">

                        <div class="row p-3">
                            
                            <div class="col-4">
                                
                                <h2>Reload Assaign List</h2>
                                <label>Devices</label>
                                <select id="device_id" class="form-control select2" name="device_id" required>
                                    <option value="" selected>Please Select</option>
                                    @foreach(\App\Models\DeviceModel::all() as $data)
                                    <option value="{{$data->id}}">{{$data->device_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary col-md-3" type="submit">Submit</button>
                                <button class="btn btn-secondary" onclick="form_reset()">Clear</button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
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
    {{-- @include('backend.report.member_assign_device.attendance_report_js') --}}
@endpush
