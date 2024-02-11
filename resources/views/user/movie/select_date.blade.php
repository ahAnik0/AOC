@extends('frontend.home.app')
@section('title','Movie')
@push('css')
<style  nonce="{{ csp_nonce() }}">
    .csss1{
        border:1px solid;
    }
</style>
@endpush
@section('content')
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/icon/movie.png")}}">
                <h1>Select Date</h1>
            </div>
        </div>
    </section>
    
    <section class="team-cols-section inn-banner-section member-page">
        <form action="{{route('user.available_seat')}}" method="get">
            @csrf
            <div class="container">
                <div class="row member-head">
                    <div class="col-lg-6">
                        <div class="team-box csss1">
                            <div class="team-person member">
                                <img src="{{asset('uploads/movie/'.$movie->poster)}}">
                                <div class="tperson-info">
                                    <h4>Movie Name : {{$movie->title}}</h4>
                                    <p>Movie Date : {{$movie->start_date}} - {{$movie->end_date}}</p>
                                    <p>Ticket Price : 100tk/price</p>
                                    <p>Movie Time : {{$movie->show_time}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="team-box csss1" >
                            <div class="f-group">
                                <input type="date" id="booking_date" name="date" min="{{$movie->start_date}}" max="{{$movie->end_date}}" required>
                                <label for="birth">Select Date*</label>
                            </div>
                            <input name="movie_id" value="{{request('movie_id')}}" hidden>
                            <br/>
                            <a href="">
                                <button class="btn btn-green" type="submit"> Continue</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
