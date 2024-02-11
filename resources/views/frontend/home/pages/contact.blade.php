@extends('frontend.home.app')
@section('title','Contact')
@push('css')
    <style nonce="{{ csp_nonce() }}">
        .course:hover {
            background-color: #265D3B;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #265D3B;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #265D3B;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
@endpush
@section('content')
    
    <section class="inn-banner-section contact-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{asset("assets/frontend/img/Contact_icon.png")}}">
                <h1>Contact With Us</h1>
            </div>
        </div>
    </section>
    
    <section class="space-ptb course-list bg-light">
        
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    
                    <table class="styled-table">
                        <thead>
                        <tr>
                            <th>SER</th>
                            <th>Department</th>
                            <th>Mobile Number</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ( $contact as $key=>$data )
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->mobile}}</td>
                            </tr>
                            @endforeach
                       
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </section>

@endsection
@push('js')
@endpush
