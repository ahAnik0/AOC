<?php

namespace App\Http\Controllers;


use App\Jobs\CustomJOb;
use App\Models\AttLogModel;
use App\Models\MemberModel;
use App\Models\PersonalContactDetailsModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
        exit();

//        ----------------

        dd(Storage::put('file.txt', 'test'));


        $today = Carbon::now()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $att = AttLogModel::query()->whereBetween('authDate', [$today, $tomorrow])->get()->groupBy('badge_number');


        dd($att);


//        $file = asset('uploads/attlog/machie.txt');
//        $every_line = file($file, FILE_IGNORE_NEW_LINES);
//        $arrey_data = [];
//        foreach ($every_line as $key => $data) {
//            $arrey_data[] = $data;


//            echo $key.'.'.$data.'<br />';
//    }

//        print_r(substr($arrey_data[50], 30, 25));

//        $enrollment_ids = [];
//        foreach ($arrey_data as $data2){
//            $enrollment_ids[] = substr($data2, 0, 5);
//        }
//


//        $section_2_dates = [];
//        foreach ($arrey_data as $data3) {
//            $section_2_dates[] = substr($data3, 5, 20);
//        }


//        $section_3_ids = [];
//        foreach ($arrey_data as $data4) {
//            $section_3_ids[] = substr($data4, 24, 4);
//        }
//
//        $section_4_names = [];
//        foreach ($arrey_data as $data5) {
//            $section_4_names[] = substr($data5, 30, 25);
//        }


//        print_r($section_2_dates);


//        $user = User::where('submit_status', 3)->get();
//
//        foreach ($user as $key => $data) {
//            echo $key++ . '.Name:-' . $data->name . $data->lastname . ' ----Country:-' . $data->country . '----Religion:-' . $data->personal_profile->p_religion . '<br>';
//        }
//    }
//
//    public function daily_submission_chart()
//    {
//        $day_by_day_payment_history = DB::table('users')->select('id', 'submit_date', 'created_at')->whereDate('users.submit_date', '>', Carbon::now()->subDays(30))->get()->groupBy
//        (function ($grouped) {
//            return (new Carbon($grouped->submit_date))->format('d/m/y');
//        });
//        foreach ($day_by_day_payment_history as $key => $value) {
//            $lebel[] = $key;
//            $data[] = $value->count();
//        }
//
//        return Response::json(['lebel' => $lebel, 'data' => $data], 200);
    }

    function test2()
    {
        $file = asset('uploads/attlog/user.txt');
        $every_line = file($file, FILE_IGNORE_NEW_LINES);
        $arrey_data = [];
        foreach ($every_line as $key => $data) {
            $arrey_data[] = $data;
//            echo $key.'.'.$data.'<br />';
        }


        $chunckedArray = array_chunk($arrey_data, 500);
        foreach ($chunckedArray as $data2) {
            CustomJOb::dispatch($data2);
        }


//        print_r(explode("-", substr($arrey_data[9894], 16, 30))[2]);

//        $bagenumber = [];
//        foreach ($arrey_data as $data4) {
//            echo $bagenumber[] = substr($data4, 5, 20) .'<br />';
//        }
//
//        $ba_no = [];
//        foreach ($arrey_data as $key=>$data4) {
//            echo $ba_no[] = substr($data4, 16, 30) .'<br />';
//        }


//        CustomJOb::dispatch($arrey_data);


//        foreach ($arrey_data as $key => $data4) {
//            if (isset(explode("-", substr($data4, 16, 30))[2])) {
//                $relation = str_replace(' ', '', explode("-", substr($data4, 16, 30))[2]);
//            } else {
//                $relation = '';
//            }
//
////            echo $key . ':' . $arrey_data[$key] = 'BadgeNumber:' . substr($data4, 5, 20) . ',  --- Ba no:' . substr($data4, 16, 30) . ',  ---- card no:' . substr($data4, 508, 15) . ',  ---- Relation:'
////                    . $relation . '-'.substr($data4, 16, 18).$relation.'<br />';
//
////            echo substr($data4, 16, 18).$relation.'<br/>';
//
//
//            $ba_no = str_replace(' ', '', substr($data4, 16, 18)) . $relation;
//            $badge_number = str_replace(' ', '', substr($data4, 5, 20));
//            $rfid = str_replace(' ', '', substr($data4, 5, 20));
//
//
//            $member = MemberModel::where('ba_no', $ba_no)->first();
//            if ($member !== null) {
//                echo $member->ba_no . '<br />';
//                $member->first();
//                $member->badge_number = $badge_number;
//                $member->rfid = $rfid;
//                $member->update();
//            }
//
//        }

        echo 'success';

    }


    private
    function find_member($ba_no)
    {
        return MemberModel::where('ba_no', $ba_no)->first();

    }


    function get_paid_and_unpaid_member()
    {
        $today = Carbon::now()->toDateString();
        $tomorrow = Carbon::now()->addDays(1)->toDateString();
        $active_user = MemberModel::where('status', '1')->whereDate('issue_date', $today)->get();
        $inactive_user = MemberModel::where('status', '0')->whereDate('expire_date', $today)->get();

        echo "Active User";
        echo '<table border="1">
                  <tr>
                    <th>ID</th>
                    <th>Member ID</th>
                    <th>Ba no</th>
                    <th>Phone</th>
                  </tr>';
        foreach ($active_user as $key => $value) {
            $key++;
            echo '
                  <tr>
                    <td>' . $key . '</td>
                    <td>' . $value->member_id . '</td>
                    <td>' . $value->ba_no . '</td>
                    <td>' . $value->phone . '</td>
                  </tr>';
        }
        echo '</table>';


        echo '<br>';
        echo '<br>';
        echo '<br>';


        echo "Need to InActive User";
        echo '<table border="1">
                  <tr>
                    <th>ID</th>
                    <th>Member ID</th>
                    <th>Ba no</th>
                    <th>Phone</th>
                  </tr>';
        foreach ($inactive_user as $key => $value) {
            $key++;
            echo '
                  <tr>
                    <td>' . $key . '</td>
                    <td>' . $value->member_id . '</td>
                    <td>' . $value->ba_no . '</td>
                    <td>' . $value->phone . '</td>
                  </tr>';

        }
        echo '</table>';
    }

    function cancel($id)
    {
        dd($id);
    }

    public function upload_log(Request $request)
    {
        return 'asdad';
        $validator = Validator::make($request->all(), [
//            'sl' => 'required',
            'dev' => 'required',
            'badge' => 'required',
            'time' => 'required',
            'record_qty' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $serial = explode(",", $request->sl);
        $device = explode(",", $request->dev);
        $badge = explode(",", $request->badge);
        $time = explode(",", $request->time);
        $no_of_records = $request->record_qty;

        $count = 0;
        $successSL = '';

        for ($i = 0; $i < $no_of_records; $i++) {
            $ro = EmplistDeviceModel::select('member_sl')->where('badge_number', $badge[$i])->where('devId', $device[$i])->first();
            if ($ro) {
                $member = $ro->member_sl;
            } else {
                $member = null;
            }
            $device_id_exist = AttLogModel::where('device_id', $device[$i])->where('badge_number', $badge[$i])->where('authDateTime', $time[$i])->first();
            if (!$member) {
                if ($device_id_exist) {
                    $device_id_exist->device_id = $device[$i];
                    $device_id_exist->badge_number = $badge[$i];
                    $device_id_exist->authDateTime = $time[$i];
                    $device_id_exist->authDate = Carbon::parse($time[$i])->toDateString();
                    $device_id_exist->authTime = Carbon::parse($time[$i])->toTimeString();
                    $device_id_exist->purpose = 1;
                    $device_id_exist->member_id = $member;
                    $device_id_exist->created_at = now();
                    $device_id_exist->updated_at = now();
                    $created = $device_id_exist->update();
                } else {
                    $created = new AttLogModel();
                    $created->device_id = $device[$i];
                    $created->badge_number = $badge[$i];
                    $created->authDateTime = $time[$i];
                    $created->authDate = Carbon::parse($time[$i])->toDateString();
                    $created->authTime = Carbon::parse($time[$i])->toTimeString();
                    $created->purpose = 1;
                    $created->member_id = $member;
                    $created->created_at = now();
                    $created->updated_at = now();
                    $created->save();
                }
            } else {
                if ($device_id_exist) {
                    $device_id_exist->device_id = $device[$i];
                    $device_id_exist->badge_number = $badge[$i];
                    $device_id_exist->authDateTime = $time[$i];
                    $device_id_exist->authDate = Carbon::parse($time[$i])->toDateString();
                    $device_id_exist->authTime = Carbon::parse($time[$i])->toTimeString();
                    $device_id_exist->purpose = 1;
                    $device_id_exist->member_id = $member;
                    $device_id_exist->created_at = now();
                    $device_id_exist->updated_at = now();
                    $created = $device_id_exist->update();
                } else {
                    $created = new AttLogModel();
                    $created->device_id = $device[$i];
                    $created->badge_number = $badge[$i];
                    $created->authDateTime = $time[$i];
                    $created->authDate = Carbon::parse($time[$i])->toDateString();
                    $created->authTime = Carbon::parse($time[$i])->toTimeString();
                    $created->purpose = 1;
                    $created->member_id = $member;
                    $created->created_at = now();
                    $created->updated_at = now();
                    $created->save();
                }
            }

            if ($created == True) {
                $count++;
            }
        }
        return response()->json(["message" => [$count . " Log Data Saved " . $successSL]], 201);
    }
}
