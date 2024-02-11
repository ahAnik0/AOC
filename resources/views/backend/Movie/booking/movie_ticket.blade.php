<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=""/>
    
    <style  nonce="{{ csp_nonce() }}">
        html {
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .flex-container {
            border: 1px solid black;
            width: 124mm;
          
           
            /* align-items: center; */
            /* transform: rotate(90deg); */
        }

        .flex-container > div {
            background-color: #f1f1f1;
            padding: 7px;
            height: 65mm;
            line-height: 18px;

            /* font-size: 30px; */
        }

        .first {
            width: 400px;
            float: left;
            font-size: 14px;
            padding: 10px;
            line-height: 19px;
        }

        .second {
            width: fit-content;
            float: left;
            border: 3px dotted;
        }

        .prothom {
            text-align: center;
            /* height: 50%; */
        }

        h4,
        p {
            margin: 0;
        }

        .vl {
            border-left: 3px dashed black;
            height: 300px;
            width: fit-content;
            float: left;
        }

        .dh {
            font-size: 12px;
        }

        input {
            border: none;
            border-bottom: 1px dashed #000;
            margin: auto;
            margin-top: 0%;
            background-color: #f1f1f1;
        }
        .css_1{
            text-align: left
        }
        .css_2{
            width: 15%
        }
        .css_3{
            width: 76%
        }
        .css_4{
            width: 64%
        }
        .css_5{
            width: 18%
        }
        .css_6{
            width: 54%
        }
        .css_7{
            width: 73%
        }
        @media print {
            body {
                -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            transform: rotate(-90deg);
            transform-origin: top left;
            width: 600px; /* Adjust width based on your needs */
            height: 400px; /* Adjust height based on your needs */
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            position: absolute;
            top: 470px; /* Position from the top */
            left: 0;
            }

           
        }
    </style>
</head>
<body >
<div class="flex-container">
    <div class="second">
        <div class="prothom">
            <img
                    src="{{asset('assets/backend/images/logo/logo.PNG')}}"
                    alt="Avatar"
                    width="60px"
                    height="60px"
            
            />
            <h4 class="army1">Army Officers Club</h4>
            <p class="cine2">Cineplex</p>
            <p class="dh3">Dhaka Cantonment,Dhaka-1206</p>
        </div>
        <br>
        <div  class="css_1">
            <label for="firstname">Serial No.</label>
            <input type="text" value="{{$booking_details->id}}" class="css_2"/>
            <label for="firstname">Show Date:</label>
            <input type="text" value="{{\Carbon\Carbon::parse($booking_details->date)->format('d/m/Y')}}" class="css_2"/>
            <label for="firstname">Show time:</label>
            <input type="text" value="{{date('h:i A', strtotime($booking_details->movie->show_time))}}" class="css_5"/>
        </div>
        <div class="css_1">
            <label for="firstname">Film:</label>
            <input type="text" value="{{ucfirst($booking_details->movie->title)}}" class="css_3"/>
        </div>
        <div class="css_1">
            <label for="firstname">Booking Name:</label>
            <input type="text" value="{{$booking_details->member->fullname}}" class="css_4"/>
        </div>
        <div class="css_1">
            <label for="firstname">Seat No:</label>
            <input type="text" value="{{ strtoupper($booking_details->seat->implode('seat_number', ',')) }}" class="css_6"/>
            <label for="firstname">Price Tk.{{$booking_details->amount}}</label>
        </div>
        <div class="css_1">
            <label for="firstname">Contact:</label>
            <input type="text" value="{{$booking_details->member->phone}}" class="css_7"/>
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
