@extends('backend.app')
@section('title','Edit Movie')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .css_1{
            height:50px;margin-top:20px
        }
        .css_2{
            margin-right: 50%;
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu','Edit Movie')
@section('content')
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Movie Panel</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-wizard" action="{{route('admin.movie/update',$movie->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label">Movie Title</label>
                                <input class="form-control" type="text" name="title" value="{{$movie->title}}">
                                {!! $errors->first('title', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Show Date start</label>
                                <input class="form-control" type="date" name="start_date" value="{{$movie->start_date}}">
                                {!! $errors->first('start_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Show Date end</label>
                                <input class="form-control" type="date" name="end_date" value="{{$movie->end_date}}">
                                {!! $errors->first('end_date', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <!-- 3 -->
                            <!-- st -->
                            <div class="mb-3">
                                <label class="col-form-label">Show time</label>
                                <input class="form-control" type="time" name="show_time" value="{{$movie->show_time}}">
                                {!! $errors->first('show_time', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            
                            <!-- end 3 -->
                            <div class="mb-3">
                                <label class="col-form-label">Trailer Link</label>
                                <input class="form-control" type="text" name="video_link" value="{{$movie->video_link}}">
                                {!! $errors->first('video_link', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Movie Poster</label>
                                <input class="form-control" type="file" name="poster" value="{{$movie->poster}}">
                                {!! $errors->first('poster', '<p class="help-block text-danger">:message</p>') !!}
                                <img src="{{asset("uploads/movie/".$movie->poster)}}" class="img-thumbnail css_1" />
                            </div>
                            
                            <div class="mb-3">
                                <label class="col-form-label">Movie Image</label>
                                <input class="form-control" type="file" name="image" value="{{$movie->image}}">
                                {!! $errors->first('image', '<p class="help-block text-danger">:message</p>') !!}
                                <img src="{{asset("uploads/movie/".$movie->image)}}" class="img-thumbnail css_1" />
                            </div>
                            <div class="mb-3">
                                <label for="validationTextarea">Movie Description</label>
                                <textarea class="form-control textarea" name="desc">{{$movie->desc}}</textarea>
                                {!! $errors->first('desc', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary css_2" type="submit" >Submit</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    @include('backend.staff_member.create_member_js')
@endpush
