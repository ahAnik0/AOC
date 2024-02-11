<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AttLogModel;
use App\Models\DeviceModel;
use App\Models\EmplistDeviceModel;
use App\Models\MemberAssignDeviceModel;
use App\Models\MemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendenceController extends Controller
{
    function device_list()
    {
        $devip = '';
        $devId = '';

        $device_list = DeviceModel::select('id', 'device_ip', 'device_name')->where('status', 1)->get();

        if ($device_list) {
            foreach ($device_list as $value) {
                if ($devip == '') {
                    $devip = $value['device_ip'];
                    $devId = $value['id'];
                } else {
                    $devip = $devip . ';' . $value['device_ip'];
                    $devId = $devId . ';' . $value['id'];
                }
            }

            return response()->json(["message" => [$devip . '=' . $devId . '=' . '0;1;1']], 201);
        } else {
            return response()->json(["error" => ["no active device found"]], 422);
        }
    }

    function upload_log(Request $request)
    {
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

    function uploadEmpList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dev' => 'required',
            'badge' => 'required',
            'name' => 'required',
            'card' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $device = explode(",", $request->dev);
        $badge = explode(",", $request->badge);
        $name = explode(",", $request->name);
        $card = explode(",", $request->card);
        $pass = explode(",", $request->pass);
        $priv = explode(",", $request->priv);
        $no_of_records = $request->record_qty;
        $count = 0;

        for ($i = 0; $i < $no_of_records; $i++) {
            if ($card[$i] == '0000000000') {
                $card[$i] = '';
            } else {
                $member_card = MemberModel::select('id')->where('rfid', $card[$i])->orderBy('id', 'DESC')->first();
                $ex_data = EmplistDeviceModel::where('devId', $device[$i])->where('badge_number', $badge[$i])->first();
                if ($member_card) {
                    $member = $member_card['id'];
                    if ($ex_data) {
                        $ex_data->devId = $device[$i];
                        $ex_data->badge_number = $badge[$i];
                        $ex_data->Name = $name[$i];
                        $ex_data->CardId = $card[$i];
                        $ex_data->pass = $pass[$i];
                        $ex_data->priv = $priv[$i];
                        $ex_data->member_sl = $member;
                        $ex_data->created_at = now();
                        $ex_data->updated_at = now();
                        $entry_counter = $ex_data->update();
                    } else {
                        $new_data = new EmplistDeviceModel();
                        $new_data->devId = $device[$i];
                        $new_data->badge_number = $badge[$i];
                        $new_data->Name = $name[$i];
                        $new_data->CardId = $card[$i];
                        $new_data->pass = $pass[$i];
                        $new_data->priv = $priv[$i];
                        $new_data->member_sl = $member;
                        $new_data->created_at = now();
                        $new_data->updated_at = now();
                        $entry_counter = $new_data->save();
                    }
                } else {
                    if ($ex_data) {
                        $ex_data->devId = $device[$i];
                        $ex_data->badge_number = $badge[$i];
                        $ex_data->Name = $name[$i];
                        $ex_data->CardId = $card[$i];
                        $ex_data->pass = $pass[$i];
                        $ex_data->priv = $priv[$i];
                        $ex_data->created_at = now();
                        $ex_data->updated_at = now();
                        $entry_counter = $ex_data->update();
                    } else {
                        $new_data = new EmplistDeviceModel();
                        $new_data->devId = $device[$i];
                        $new_data->badge_number = $badge[$i];
                        $new_data->Name = $name[$i];
                        $new_data->CardId = $card[$i];
                        $new_data->pass = $pass[$i];
                        $new_data->priv = $priv[$i];
                        $new_data->created_at = now();
                        $new_data->updated_at = now();
                        $entry_counter = $new_data->save();
                    }
                }
                if ($entry_counter == True) {
                    $count++;
                }
            }
        }
        return response()->json(["message" => [$count . " User Data Saved in Web"]], 201);
    }

    function syncid(Request $request)
    {
    //    return $request;
        $validator = Validator::make($request->all(), [
            'dev' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $device_ip = $request->dev;
        $max_badge = '';
        //get device id
        $device_name = DeviceModel::select('id')->where('device_ip', $device_ip)->first();

        if ($device_name) {
            $devId = $device_name['id'];

           $member_assign_data = MemberAssignDeviceModel::select('id', 'member_id', 'card_id', 'status')->where('device_id', $devId)->where('status', [1, 2])->get();
        //    return $member_assign_data;

            $cardA = '';
            $statusA = '';
            $idA = '';
            $nameA = '';
            foreach ($member_assign_data as $value) {
                $member = $value['member_id'];
                $card = $value['card_id'];
                $status = $value['status'];
                $id = $value['id'];

                if (strlen($card) == 10) {
                    $member_full_name = MemberModel::select('fullname')->find($member) ? MemberModel::find($member) : null;
                    if ($member_full_name) {
                        if ($cardA == '') {
                            $cardA = $card;
                            $statusA = $status;
                            $idA = $id;
                            $nameA = $member_full_name->fullname;
                        } else {
                            $cardA = $cardA . ';' . $card;
                            $statusA = $statusA . ';' . $status;
                            $idA = $idA . ';' . $id;
                            $nameA = $nameA . ';' . $member_full_name->fullname;
                        }
                    }
                } else {
                    $update_member_assign_device = MemberAssignDeviceModel::find($id);
                    $update_member_assign_device->status = 10;
                    $update_member_assign_device->updated_at = now();
                    $update_member_assign_device->update();
                }
            }
            // return $cardA ;
            return response()->json(["message" => [$idA . '=' . $cardA . '=' . $statusA . '=' . $nameA . '=' . $max_badge]], 201);
        } else {
            return response()->json(["error" => ["invalid device ip"]], 422);
        }
    }

    function UpdateStatus(Request $request)
    {
        $count = 0;
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $status = explode(",", $request->status);

        for ($i = 0; $i < count($status); $i++) {
            $update_member_assign_device = MemberAssignDeviceModel::find($status[$i]);
            $update_member_assign_device->status = 0;
            $update_member_assign_device->updated_at = now();
            $updated = $update_member_assign_device->update();
            if ($updated) {
                $count += 1;
            }
        }
        return response()->json(["message" => [$count . " Status Updated"]], 201);
    }

}
