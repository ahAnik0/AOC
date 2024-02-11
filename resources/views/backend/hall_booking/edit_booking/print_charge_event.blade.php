<!DOCTYPE html>
<html>

<head>
    <style  nonce="{{ csp_nonce() }}">
        /*html {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*}*/
        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }
        #invoice-POS .service1 {
            height: 2px !important;
            padding: 0px;
            border-bottom: 1px solid #000000;
        }
        #invoice-POS .service1 p{
            line-height: 0px !important;
        }
        #invoice-POS .service1 td{
            width: 50px !important;
        }

        #invoice-POS {
            /*box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);*/
            border: 2px solid;
            /*padding: 2mm;*/
            /*margin: 0 auto;*/
            width: 65mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #000000;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #000000;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.8em;
            color: #000000;
            line-height: 1.2em;
            font-weight: bolder;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #000000;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url({{ asset('assets/backend/images/logo/logo.PNG') }}) no-repeat;
            background-size: 60px 60px;
            margin: auto;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
            /* height: 0.7em; */
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: 0.8em;
            background: #EEE;
            border-top: 1px solid;
            border-bottom: 1px solid;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #000000;
        }
        /* #invoice-POS .service1 {
            height: 50px;
            padding: 0px;
        } */

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: 0.8em;
            /* width:120px; */
        }
        #invoice-POS .payment {
            text-align: center;
        }
        .css_1{
            text-align: center
        }
        .css_2{
            text-align: left
        }
        /*#invoice-POS #legalcopy {*/
        /*    margin-top: 5mm;*/
        /*}*/
    </style>

</head>

<body >

    <div id="invoice-POS">

        <center id="top">
            <div class="logo"></div>
            <div class="info">
                <h2>ARMY OFFICERS CLUB</h2>
            </div>
        </center>

        <div id="mid" class="css_1">
            <div class="info">
                <p>
                    Name : {{ $member->fullname }}</br>
                    Member ID : {{ $member->id }}</br>
                    Ba No : {{ $member->ba_no }}</br>
                    Phone : {{ $member->phone }}</br>
                    Print Date: {{\Carbon\Carbon::now()->format('Y-m-d g:i A')}}
                </p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table class="css_2">
                    <tr class="tabletitle">
                        <td class="item"></td>
                        <td class="Hours"></td>
                    </tr>
                    <tr class="service1" >
                        <td class="tableitem">
                            <p class="itemtext">
                                Hall Rent: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->hall_rent }}
                            </p>
                        </td>
                        
                    </tr>

                    <tr class="service1" >
                        <td class="tableitem">
                            <p class="itemtext">
                                Hall Vat(15%): 
                            </p>
                        </td>
                        <td class="tableitem1">
                            <p class="payment1">
                                {{ $charge->hall_vat }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Current Bill: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->current_bill }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Cookeries Bill: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->cookeries_bill }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Cook House Bill: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->cook_house_bill }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Event Charge: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->event_charge }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Event Vat(15%): 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->event_vat }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Catering Bill: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->catering_bill }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Catering Bill Vat(15%): 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->catering_bill_vat }}
                            </p>
                        </td>
                    </tr>
                    <tr class="service1">
                        <td class="tableitem">
                            <p class="itemtext">
                                Damage Bill: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="payment">
                                {{ $charge->damage_bill }}
                            </p>
                        </td>
                    </tr>
                    

                    <tr class="tabletitle">
                        <td class="Rate">
                            <h2>Total Amount:</h2>
                        </td>
                        <td class="payment">
                            <h2>{{ $amount =  $charge->hall_rent+$charge->hall_vat+$charge->current_bill+
                            $charge->cookeries_bill+ $charge->cook_house_bill+$charge->event_charge+
                            $charge->event_vat+ $charge->catering_bill+$charge->damage_bill+
                            $charge->catering_bill_vat }}Tk</h2>
                        </td>
                    </tr>

                </table>
            </div>

            <div id="legalcopy">
                <p class="legal css_1" ><strong>Hallbooking Receipt</strong></p>
                {{-- <p class="legal" style="text-align: right"><strong>Signature...............................</strong></p> --}}
            </div>
        </div>
    </div>

</body>
<script  nonce="{{ csp_nonce() }}">
    window.onload = function() {
        window.print();
    };
</script>

</html>
