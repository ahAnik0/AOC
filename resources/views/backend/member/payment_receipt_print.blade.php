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

        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #000000;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
            text-align: center;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url({{asset('assets/backend/images/logo/logo.PNG')}}) no-repeat;
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
            text-align: center
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
            text-align: center;
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
            text-align: center;
        }
        #invoice-POS .tableitem{
            text-align: center
        }

        #invoice-POS #legalcopy .legal {
            text-align: center;
        }
    
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

        <div id="mid" style="text-align: center">
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
                <table style="text-align: center">
                    <tr class="tabletitle">
                        <td class="item"></td>
                        <td class="Hours"></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                Issue Date: - <br>
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                {{ \Illuminate\Support\Carbon::parse($request->pay_date)->format('M d, Y') }} <br>
                            </p>
                        </td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                Month: - <br>
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                               {{$request->month}} <br>
                            </p>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                Payment Type: - <br>
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                <?php if ($request->pay_type == 0) {
                                    echo 'Cash';
                                } elseif ($request->pay_type == 1) {
                                    echo "Cheque <br>";  
                                    echo 'Cheque No:'.$request->chq_no ; 
                                } elseif($request->pay_type ==2){
                                    echo "Bank Reciept <br>";  
                                    echo 'Reciept No:'.$request->chq_no ;  
                                }else{
                                    echo "Online Transation <br>";  
                                    echo 'Transation No:'.$request->chq_no ; 
                                }
                                ?> <br>
                            </p>
                        </td>
                    </tr>



                    {{--                <tr class="service"> --}}
                    {{--                    <td class="tableitem"><p class="itemtext">Monthly bill</p></td> --}}
                    {{--                    <td class="tableitem"><p class="itemtext" style="word-wrap: break-word;">200TK</p></td> --}}
                    {{--                    <td class="tableitem"><p class="itemtext"></p>-</td> --}}
                    {{--                </tr> --}}

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
                <p class="legal" style="text-align: center"><strong>Membership Receipt</strong></p>
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
