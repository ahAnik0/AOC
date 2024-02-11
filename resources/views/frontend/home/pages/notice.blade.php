@extends('frontend.home.app')
@section('title','Notice')
@push('css')
@endpush
@section('content')
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/notice_icon.png")}}">
                <h1>Notice/ Report</h1>
            </div>
        </div>
    </section>
    
    
    <section class="notice-section">
			<div class="container">
				<div class="row">
					@foreach ($notice as $data )
					<div class="col-lg-12">
						<div class="notice-box">
							<h2>{{$data->title}}</h2>
							<p class="meta">Notice । {{\Carbon\Carbon::create($data->date)->format('dF Y')}}</p>
							<div class="btn-set">
								<a  href="{{asset($data->pdf)}}" class="btn btn-dark"><i class="fa fa-eye"></i> Read More</a>
								<a href="{{asset($data->pdf)}}"  class="btn btn-green" download><i class="fa fa-download" ></i> Download</a>
							</div>
						</div>
					</div>
					@endforeach

					

					{{-- <div class="col-lg-12">
						<div class="notice-box">
							<h2>AOC-BOOKING RECEIPT</h2>
							<p class="meta">Notice । 20July 2022</p>
							<div class="btn-set">
								<a  href="{{("assets/frontend/pdf/Booking From.pdf")}}" class="btn btn-dark"><i class="fa fa-eye"></i> Read More</a>
								<a href="{{("assets/frontend/pdf/Booking From.pdf")}}" class="btn btn-dark" class="btn btn-green" download><i class="fa fa-download" ></i> Download</a>
							</div>
						</div>
					</div>
					

					<div class="col-lg-12">
						<div class="notice-box">
							<h2>FOREIGNER’S (MILITARY/CIVIL) BIO-DATA</h2>
							<p class="meta">Notice । 20July 2022</p>
							<div class="btn-set">
								<a  href="{{("assets/frontend/pdf/FOREIGNERS SY CL.pdf")}}" class="btn btn-dark"><i class="fa fa-eye"></i> Read More</a>
								<a href="{{("assets/frontend/pdf/FOREIGNERS SY CL.pdf")}}" class="btn btn-dark" class="btn btn-green" download><i class="fa fa-download" ></i>
                                    Download</a>
							</div>
						</div>
					</div> --}}

				</div><!-- .row -->
			</div>
		</section>

@endsection
@push('js')
@endpush
