@extends('backend.app')
@section('title','Edit Menu')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit Menu')
@section('link',route('admin.adminDashboard'))
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Edit Menu</h3></div>
                <div class="card-body">
                    <form class="forms-sample" method="post" action="{{route('admin.menu/update_menu',$menu->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Menu Name</label>
                            <input type="text" class="form-control" value="{{$menu->menu_name}}" name="menu_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Menu Bangla Name</label>
                            <input type="text" class="form-control" value="{{$menu->menu_name_bn}}" name="menu_bangla_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Icon Class</label>
                            <input type="text" class="form-control" value="{{$menu->menu_icon_class}}" name="icon_class">
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Activation Status</label>
                                <select class="form-control select2" name="active_status">
                                    <option value="1" {{$menu->menu_is_active==1?'selected':''}}>Active</option>
                                    <option value="0" {{$menu->menu_is_active==0?'selected':''}}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Select Parent Menu</label>
                                <select class="form-control select2" name="parent_id">
                                    <option value="" >No Parent</option>
                                    @foreach($master_menu as $data)
                                        <option value="{{$data->id}}" {{$menu->menu_parent_id == $data->id?'selected':''}}>{{$data->menu_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Select Route</label>
                                <select class="form-control select2" name="route_id">
                                    <option disabled selected>Cheese</option>
                                    <option value="" >No Route</option>
                                    @foreach($route as $data)
                                        <option
                                            value="{{$data->id}}" {{$menu->menu_dynamic_route_id == $data->id?'selected':''}}>{{$data->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
