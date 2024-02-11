<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Card back</title>
    <style>
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

    </style>
</head>

<body>
<div class="card2">
    <div style="padding: 15px 18px 10px 15px;font-size: 11px">
        <p style="font-weight: bold;margin: 0">Blood Group: {{ $member->blood_group ? $member->blood_group->name : ''}}</p>
        <p style="font-weight: bold;margin: 0">Emergency Contact: {{ $member->emergency_contact_no }}</p>
        <p style="font-weight: bolder;margin: 4px 0;font-size: 13px;">Membership No: {{ $member->member_id_inputed }}</p>
        <p style="margin: 0;text-align: justify;font-size: 10px">This card is the property of Army Officer's Club.
            Dhaka to whom it must be returned upon or if found The use of this covered by the terms and conditions
            of the Army Officers' Club: Dhaka.</p>
        <p style="text-align: justify;font-size: 10px;margin: 5px 0;">If found please return to Army
            Officers Club. Dhaka. Cantonment. Dhaka-1206</p>
        {!! $barcode !!}
    </div>
</div>
</body>
</html>
