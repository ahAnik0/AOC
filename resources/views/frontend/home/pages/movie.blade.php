@extends('frontend.home.app')
@section('title','Movie')
@push('css')

@endpush
@section('content')
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/icon/movie.png")}}">
                <h1>Running Movie</h1>
            </div>
        </div>
    </section>
    
    <section class="team-cols-section">
        <div class="container">
            <div class="row">
                @foreach($movie as $data)
                    <div class="col-lg-4">
                        <div class="team-box border">
                            <div class="col-thumb">
                                <img src="{{asset('uploads/movie/'.$data->poster)}}">
                            </div>
                            <h2>{{$data->title}}</h2>
                            <p class="text-center">{{\Illuminate\Support\Carbon::parse($data->start_date)->format('M d, Y')}} - {{\Illuminate\Support\Carbon::parse($data->end_date)->format('M d, Y')
                        }}</p>
                        <a href="{{route('user.movie_set_date',$data->id)}}" class="btn btn-coffee btn-block">Book Now<i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    
    <section class="inn-banner-section member-page-footer">
        <div class="container">
            <div class="inn-banner">
                <div>
                    <h1>For Manual Booking plz contact</h1>
                    <h2>01769013759 Cineplex (SGT Sahin)</h2>
                </div>
                <a href="tel:+8801769013759" class="btn btn-coffee">Call<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </section>


@endsection
@push('js')
@endpush
