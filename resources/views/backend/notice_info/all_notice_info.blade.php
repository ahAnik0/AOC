@extends('backend.app')
@section('title','All Notice/Info')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','All Notice/Info')
@section('link',route('admin.dynamic_route'))
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Total: <span class="badge badge-secondary">{{$notice->count()}}</span></h3>
            @if($page_data['add_menu'] == "yes")
                <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#add_button">Add
                    Notice/Info</a>
            @endif
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notice as $key=>$data)
                    @if($data->id == 92)
                    @else
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{($data->type == 0) ? 'Notice' : 'Information' }}</td>
                        <td>{{\Carbon\Carbon::create($data->date)->format('dF Y')}}</td>
                        <td>
                            <a href="#" onclick="edit_user({{$data->id}})" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{route('admin.delete_notice_info',$data->id)}}" onclick="return confirm('Are you Sure to Delete !!')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
               
            </table>
        </div>
    </div>

    @if($page_data['modal'] == "yes")
        @include('backend.notice_info.add_notice_info_modal')
        @include('backend.notice_info.edit_notice_info_modal')
    @endif

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        // edit user
        function edit_user(id) {
            event.preventDefault();
            $.ajax({
                url: "{{url('admin/edit_notice_info')}}/" + id,
                type: "GET",
                data: {},
                success: function (response) {
                    if (response) {
                        if (response.permission == false) {
                            toastr.error('you dont have that Permission', 'Permission Denied');
                        } else {
                            $('#edit_body').html('')
                            $('#edit_body').append(response)
                            $('#edit_user').modal('show');
                        }
                    }
                },
            });
        }

       

    </script>

@endpush
