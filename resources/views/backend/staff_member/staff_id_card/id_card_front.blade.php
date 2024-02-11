<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Card</title>
    <style  nonce="{{ csp_nonce() }}">
        html {
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .card {
            width: 2.13in;
            height: 3.37in;
            position: relative;
            border-radius: 5px;
            overflow: hidden;
            /*border: 1px solid;*/
        }

        .container {
            padding: 5px;
        }

        .title {
            text-transform: uppercase;
            color: #00693E;
            text-align: center;
            font-size: 12px;
            margin: 6px 0;
            font-weight: bolder;
        }
        .css_1{
            display: flex;margin: 5px 8px 0 8px;height: 95px;padding:3px;
        }
        .css_2{
            float: right;width: 83px;height: 90px;border-radius: 3px
        }
        .css_3{
            margin: 0 8px;font-size: .61rem;height: 120px;
        }
        .css_4{
            width: 50%;float: left;color:#000000;overflow-wrap: break-word;
        }
        .css_5{
            margin: 0;font-weight: bold"
        }
        .css_6{
            font-weight: normal
        }
        .css_7{
            width: 47%;float: right;overflow-wrap: break-word;
        }
        .css_8{
            font-weight: bolder;color: #000000;font-size: .65rem;
        }
        .css_9{
            float: right;height: 60px;margin-top: 8px;margin-right: 10px
        }
        .css_10{
            height: 44px;font-size: 11px;margin: 0 8px 0 8px
        }
        .css_11{
            width: 40%;float: left;
        }
        .css_12{
            height: 25px;width: 60%;margin-left: 20px;margin-bottom: 2px;
        }
        .css_13{
            width: 100%;border-bottom: 1px solid #000000;margin-bottom: 1px
        }
        .css_14{
            text-align: center;margin: 0;font-size: 10px;font-weight: bold
        }
        .css_15{
            height: 25px;width: 60%;margin-left: 20px;margin-bottom: 3px;
        }
        .css_16{
            width: 100%;border-bottom: 1px solid #000000;margin-bottom: 1px
        }
        .css_17{
            text-align: center;margin: 0;font-size: 10px;font-weight: bold
        }
        .css_18{
            width: 100%;height: 22px;margin-top: -8px;background: #0f3cdd
        }
        .css_19{
            font-size: 9px;text-align: center;color: white;padding-top: 3px
        }
    </style>
</head>

<body>
<div class="card main">
    <div class="container">
        <h4 class="title">Army Officers' club, Dhaka</h4>
        <div class="image_container css_1" >
            <img src="{{ asset('assets/backend/images/logo/logo.PNG') }}" alt="official logo" height="65px"/>

            <img src="{{ asset('uploads/staff_img/' . $member->photo) }}" alt="profile photo"
                 class="css_2"/>
        </div>

        <div class="details_container css_3">
            <div class="details css_4" >
                <p class="css_5">
                    <span class="css_6">Card No: </span>{{ $member->id }} <br/>
                    <span class="css_6">Appointment:</span><br>{{ $member->appointment }} <br/>
                    <span class="css_6">DOB: </span>{{ \Carbon\Carbon::parse($member->dob)->format('d M, Y') }} <br/>
                    <span class="css_6">Issue Date:</span><br>{{ \Carbon\Carbon::parse($member->issue_date)->format('d M, Y') }} <br/>
                    <span class="css_6">Expiry Date:</span><br>
                    {{ \Carbon\Carbon::parse($member->expire_date)->format('d M, Y') }} <br/>
                </p>
            </div>
            <div class="right_side_content css_7" >
                <div class="name_container css_8" >
                        {{ $member->name }}
                </div>
                <div class="qr_code_container">
                    <img src="data:image/png;base64, {!! $qrcode !!}" class="css_9">
                </div>
            </div>
        </div>

        <div class="sign_container css_10" >
            <div class="left_sigh css_11">
                <img src="{{ asset('uploads/staff_img/' . $member->signature) }}" alt="profile photo"
                     class="css_12"/>
                <div class="css_13"></div>
                <p class="css_14">Holder's Sign</p>
            </div>
            <div class="holder_sign css_11" >
                <img src="{{ asset('uploads/setting/'.\App\Models\SettingModel::where('name','ceo_image')->first()->image) }}" alt="profile photo"
                     class="css_15"/>
                <div class="css_16"></div>
                <p class="css_17">Club President</p>
            </div>
        </div>
    </div>
    <div class="footer css_18">
        <p class="css_19">
            Issuing Authority: Army Officers' Club, Dhaka
        </p>
    </div>
</div>
</body>
</html>
