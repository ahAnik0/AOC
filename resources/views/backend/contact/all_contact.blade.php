@extends('backend.app')
@section('title','All Contact')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','All Contact')
@section('link',route('admin.dynamic_route'))
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Total: <span class="badge badge-secondary">{{$contact->count()}}</span></h3>
            @if($page_data['add_menu'] == "yes")
                <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#add_button">Add
                    Contact</a>
            @endif
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contact as $key=>$data)
                    @if($data->id == 92)
                    @else
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->mobile}}</td>
                        <td>
                            <a href="#" onclick="edit_user({{$data->id}})" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{route('admin.delete_contact',$data->id)}}" onclick="return confirm('Are you Sure to Delete !!')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
               
            </table>
        </div>
    </div>

    @if($page_data['modal'] == "yes")
        @include('backend.contact.add_contact_modal')
        @include('backend.contact.edit_contact_modal')
    @endif

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        // edit user
        function edit_user(id) {
            event.preventDefault();
            $.ajax({
                url: "{{url('admin/edit_contact')}}/" + id,
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
