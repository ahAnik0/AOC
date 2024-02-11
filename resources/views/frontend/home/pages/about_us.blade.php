@extends('frontend.home.app')
@section('title', 'About Us')
{{-- @push('css') --}}
    <style nonce="{{ csp_nonce() }}">
        .css_1 {
            margin: 0cm;
            font-size: 13px;
            font-family: "Times New Roman", serif;
            text-align: justify;
        }

        .css_2 {
            margin: 0cm;
            font-size: 13px;
            font-family: "Times New Roman", serif;
            margin-left: 36.0pt;
            text-align: justify;
            line-height: 150%;
        }

        .css_3 {
            margin: 0cm;
            font-size: 13px;
            font-family: "Times New Roman", serif;
            margin-left: 72.0pt;
            text-align: justify;
        }

        .css_4 {
            margin: 0cm;
            font-size: 13px;
            font-family: "Times New Roman", serif;
            margin-left: 36.0pt;
            text-align: justify;
        }

        .css_5 {
            font-size: 17px;
            font-family: "Calibri", sans-serif;
        }

        .css_6 {
            font-size: 12px;
            font-family: "Calibri", sans-serif;
        }
        .css_7{
            font-size:16px;font-family:"Calibri",sans-serif;
        }
        .css_8{
            font-size:17px;line-height:150%;font-family:"Calibri",sans-serif;
        }
        .css_9{
            font-size:11px;font-family:"Calibri",sans-serif;
        }
    </style>
{{-- @endpush --}}
@section('content')
    <section class="inn-banner-section contact-page">
        <div class="container">
            <div class="inn-banner">
                <img src="{{ asset('assets/frontend/img/Contact_icon.png') }}">
                <h1>About Us</h1>
            </div>
        </div>
    </section>


    <section class="space-ptb course-list bg-light">

        <div class="container ">
            <div class="row">
                <div class="col-md-12">

                    <p class="css_1"><span class="css_5">Army Officers Club Complex with very modern facilities of
                            international standards has been constructed by Bangladesh Army in Nirjhor residential area of
                            Dhaka Cantonment. Although the Officers Club initially started on a small scale, it started its
                            journey with full enthusiasm by starting the club activities in the newly constructed building
                            from April 2018. The building is constructed as a megastructure with a highly aesthetic
                            architectural style as the Central Officers Club Complex of the Bangladesh Army. The Army
                            Officers Club incorporates all state-of-the-art facilities to enable officers and their families
                            to meet their club activities, social functions, indoor sports and health facilities along with
                            entertainment and limited convenience shopping in the same building. Details of all existing
                            facilities/establishment in Army Officers Club Complex are as follows:</span>
                    </p>
                    <p class="css_1"><span class="css_6">&nbsp;</span>
                    </p>
                    <p class="css_2"><span class="css_8">1.
                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Club facilities</u>.</span></p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Officers Club.</span></p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Ladies Club.</span></p>
                    <p class="css_3"><span class="css_5">c. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Children&apos;s Club.</span>
                    </p>
                    <p class="css_4"><span class="css_5">&nbsp;</span></p>
                    <p class="css_2"><span class="css_8">2.
                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Conventions are conveniences</u>.</span></p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Multipurpose Hall-1 (Banquet
                            Hall).</span></p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Multipurpose Hall-2 (Practice
                            Hall).</span></p>
                    <p class="css_4"><span class="css_7">&nbsp;</span></p>
                    <p class="css_2"><span class="css_8">3.
                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Recreational facilities</u>.</span></p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;3D Cineplex.</span></p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Book store.</span></p>
                    <p class="css_4"><span class="css_7">&nbsp;</span></p>
                    <p class="css_2"><span class="css_8">4.
                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Indoor sports facilities</u>.</span></p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Bowling Center.</span></p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Billiards and table
                            tennis.</span></p>
                    <p class="css_3"><span class="css_5">c. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Army Tennis and Squash
                            Complex.</span></p>
                    <p class="css_4"><span class="css_7">&nbsp;</span></p>
                    <p class="css_2"><span
                            class="css_8">5.&nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp;<u>Fitness facilities</u>.</span></p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Swimming pool complex.</span>
                    </p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Gymnasium (Men &amp;
                            Women).</span></p>
                    <p class="css_3"><span class="css_5">c. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Sauna and Steam Bath (for
                            both men and women).</span></p>
                    <p class="css_4"><span class="css_7">&nbsp;</span></p>
                    <p class="css_2"><span class="css_8">6.
                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>Lifestyle, Grooming and Barber shop facilities</u>.</span>
                    </p>
                    <p class="css_3"><span class="css_5">a. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Beauty parlor (for
                            ladies).</span></p>
                    <p class="css_3"><span class="css_5">b. &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Grooming zone and barber shop
                            (for men).</span></p>
                    <p class="css_4"><span class="css_9">&nbsp;</span></p>
                    <p class="css_4"><span class="css_5">7. <u>Food and convenience shopping facilities</u>. &nbsp; &nbsp;
                            &nbsp;Six Cafeterias/Rental Convenience Stores/Shops.</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
@endpush
