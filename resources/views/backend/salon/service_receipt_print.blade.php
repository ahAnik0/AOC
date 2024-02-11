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
        .css_2{
            text-align: center;margin-top: -10px
        }
        .css_1{
            text-align: center
        }
        .css_3{
            word-wrap: break-word;
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
    
    <div id="mid" class="css_1">
        <div class="info">
            <p>
                Name : {{$service->member->fullname}}</br>
                Member ID : {{$service->member->id}}</br>
                Ba No : {{$service->member->ba_no}}</br>
                Phone : {{$service->member->phone}}</br>
            </p>
        </div>
    </div>
    
    <div id="bot">
        
        <div id="table">
            <table class="css_1" border="1">
                <tr class="tabletitle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours"><h2>Qty</h2></td>
                    <td class="Rate"><h2>Sub Total</h2></td>
                </tr>
                
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Number of person</p></td>
                    <td class="tableitem"><p class="itemtext">{{$service->number_of_person}}</p></td>
                    <td class="tableitem"><p class="itemtext"></p>-</td>
                </tr>
                
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Guest Member</p></td>
                    <td class="tableitem"><p class="itemtext css_3" >{{implode(PHP_EOL, str_split($service->name_of_guests, 5))}}</p></td>
                    <td class="tableitem"><p class="itemtext"></p>-</td>
                </tr>
                
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Amount</p></td>
                    <td class="tableitem"><p class="itemtext"></p>-</td>
                    <td class="tableitem"><p class="itemtext">{{$service->amount}} Tk</p></td>
                </tr>
            
            </table>
        </div>
        
        <div id="legalcopy">
            <p class="legal css_1" ><strong>Service name: {{$service->service_details}}</strong></p>
            <p class="legal css_2" ><strong>Service ID: {{$service->id}}</strong></p>
        </div>
    </div>
</div>

</body>

</html>
<script src="{{asset('assets/backend/js/jquery-3.5.1.min.js')}}"></script>
<script  nonce="{{ csp_nonce() }}">
    window.onload = function() {
        window.print();
    };
</script>
