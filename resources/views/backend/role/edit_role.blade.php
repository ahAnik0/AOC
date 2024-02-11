@extends('backend.app')
@section('title','Edit Role')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit Role')
@section('link',route('admin.adminDashboard'))
@section('content')



    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.update_role',$role->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Route_name">Roel name</label>
                    <input type="text" class="form-control" id="Role name"
                           value="{{$role->name}}" name="name">
                </div>
                Permission
                <hr>

                <input type="checkbox" onclick="toggle(this);"/>Check all?<br/>

                <div class="col-xs-12">
                    <div class="row">
                        @foreach($route as $head=>$data1)
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{$head}}</h5>
                                </div>
                                <ul class="list-group">
{{--                                    <li class="list-group-item"><span class="text-bold">{{$head}}</span>--}}
                                        @foreach($data1 as $data2)
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="checkbox checkbox-solid-success">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="{{$data2->id}}"
                                                               id="defaultCheck.{{$data2->id}}"
                                                               name="route_name[]" {{ ( $permission_route->where('dynamic_route_id',$data2->id)->count() !== 0) ? 'checked' : '' }}>
                                                        <label
                                                               for="defaultCheck.{{$data2->id}}">
                                                            {{$data2->title}}
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
{{--                                    </li>--}}
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>


                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>









@endsection
@push('js')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endpush
