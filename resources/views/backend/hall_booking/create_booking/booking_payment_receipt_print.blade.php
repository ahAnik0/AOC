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

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: 0.8em;
        }
        .css_1{
            text-align: center
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
                </p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table class="css_1">
                    <tr class="tabletitle">
                        <td class="item"></td>
                        <td class="Hours"></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                Program Date: - <br>
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                {{ \Illuminate\Support\Carbon::parse($request->date)->format('M d, Y') }} <br>
                            </p>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                Hall No: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                {{ ucfirst($request->hall)}}
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                Shift: 
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                               <?php
                                    if($request->shift == 0){
                                        echo 'Day';
                                    }else{
                                        echo 'Night';
                                    } 
                                ?>
                            </p>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="Rate">
                            <h2>Program Duration:</h2>
                        </td>
                        <td class="payment">
                            <h2>{{ $request->duration }}</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td class="Rate">
                            <h2>Total Amount:</h2>
                        </td>
                        <td class="payment">
                            <h2>{{ $request->amount }}Tk</h2>
                        </td>
                    </tr>

                </table>
            </div>

            <div id="legalcopy">
                <p class="legal css_1" ><strong>Hallbooking Receipt</strong></p>
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
