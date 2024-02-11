<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Card back</title>
    <style  nonce="{{ csp_nonce() }}">
        html {
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .card2 {
            width: 3.37in;
            height: 2.13in;
            position: relative;
            border-radius: 3px;
        }
        .css_1{
            padding: 15px 18px 10px 15px;font-size: 11px
        }
        .css_2{
            font-weight: bold;margin: 0
        }
        .css_3{
            font-weight: bolder;margin: 4px 0;font-size: 13px;
        }
        .css_4{
            margin: 0;text-align: justify;font-size: 10px
        }
        .css_5{
            text-align: justify;font-size: 10px;margin: 5px 0;
        }
    </style>
</head>

<body>
<div class="card2">
    <div class="css_1">
        <p class="css_2">Name: {{ $member->name }}</p>
        <p class="css_2">Phone: {{ $member->phone }}</p>
        <p class="css_3">Card No: {{ $member->id }}</p>
        <p class="css_4">This card is the property of Army Officer's Club.
            Dhaka to whom it must be returned upon or if found The use of this covered by the terms and conditions
            of the Army Officers' Club: Dhaka.</p>
        <p class="css_5">If found please return to Army
            Officers Club. Dhaka. Cantonment. Dhaka-1206</p>
        {!! $barcode !!}
    </div>
</div>
</body>
</html>
