<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Card</title>
    <style>
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
    </style>
</head>

<body>
<div class="card main">
    <div class="container">
        <h4 class="title">Army Officers' club, Dhaka</h4>
        <div class="image_container" style="display: flex;margin: 5px 8px 0 8px;height: 95px;padding:3px;">
            <img src="{{ asset('assets/backend/images/logo/logo.PNG') }}" alt="official logo" height="65px"/>

            <img src="{{ asset('uploads/member_Photograph/' . $member->photo) }}" alt="profile photo" style="float: right;width: 83px;height: 90px;border-radius: 3px"/>
        </div>

        <div class="details_container" style="margin: 0 8px;font-size: .8rem;height: 120px;">
            <div class="details" style="width: 50%;float: left;color:#000000;">
                <p style="margin: 0;font-weight: bold">
                    <span style="font-weight: normal">Membership No:</span><br/>{{ $member->member_id_inputed }} <br/>
{{--                    <span style="font-weight: normal">Authorized To:</span><br/>Bowling--}}
{{--                    <br/>--}}
{{--                    Gymnasium <br/>--}}
{{--                    Swimming Pool <br/>--}}
{{--                    Tennis & Squash <br/>--}}
                    <span style="font-weight: normal">Issue Date:</span>
                    <br/>{{ \Carbon\Carbon::parse($member->issue_date)->format('d M Y') }} <br/>
{{--                    <span style="font-weight: normal">Expiry Date:</span> <br/>--}}
{{--                    {{ \Carbon\Carbon::parse($member->expire_date)->format('Y M d') }} <br/>--}}
                </p>
            </div>
            <div class="right_side_content" style="width: 47%;float: right;overflow-wrap: break-word;">
                <div class="name_container" style="font-weight: bolder;color: #000000;font-size: .6rem;">
                        {{ $member->fullname }}
                </div>
                <div class="qr_code_container">
                    <img src="data:image/png;base64, {!! $qrcode !!}" style="float: right;height: 60px;margin-top: 8px;margin-right: 10px">
                </div>
            </div>
        </div>

        <div class="sign_container" style="height: 44px;font-size: 11px;margin: 0 8px 0 8px">
            <div class="left_sigh" style="width: 40%;float: left;">
                <img src="{{ asset('uploads/member_sigh/' . $member->signature) }}" style="height: 25px;width: 60%;margin-left: 20px;margin-bottom: 2px;"/>
                <div style="width: 100%;border-bottom: 1px solid #000000;margin-bottom: 1px"></div>
                <p style="text-align: center;margin: 0;font-size: 10px;font-weight: bold">Holder's Sign</p>
            </div>
            <div class="holder_sign" style="width: 40%;float: right">
                <img src="{{ asset('uploads/setting/'.\App\Models\SettingModel::where('name','ceo_image')->first()->image) }}" alt="profile photo" style="height: 25px;width: 60%;margin-left: 20px;margin-bottom: 3px;"/>
                <div style="width: 100%;border-bottom: 1px solid #000000;margin-bottom: 1px"></div>
                <p style="text-align: center;margin: 0;font-size: 10px;font-weight: bold">Club President</p>
            </div>
        </div>
    </div>
    <div class="footer" style="width: 100%;height: 22px;margin-top: -8px;background: #e90b1d">
        <p style="font-size: 9px;text-align: center;color: white;padding-top: 3px">
            Issuing Authority: Army Officers' Club, Dhaka
        </p>
    </div>
</div>
</body>
</html>
