@extends('frontend.home.app')
@section('title','Information')
@push('css')
@endpush
@section('content')
    <section class="inn-banner-section notice-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/notice_icon.png")}}">
                <h1>Information</h1>
            </div>
        </div>
    </section>

    <section class="notice-section">
			<div class="container">
				<div class="row">
					@foreach ($info as $data )
					<div class="col-lg-12">
						<div class="notice-box">
							<h2>{{$data->title}}</h2>
							<p class="meta">Information । {{\Carbon\Carbon::create($data->date)->format('dF Y')}}</p>
							<div class="btn-set">
								<a  href="{{asset($data->pdf)}}" class="btn btn-dark"><i class="fa fa-eye"></i> Read More</a>
								<a href="{{asset($data->pdf)}}" class="btn btn-dark" class="btn btn-green" download><i class="fa fa-download" ></i> Download</a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>

@endsection
@push('js')
@endpush
