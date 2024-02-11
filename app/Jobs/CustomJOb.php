<?php

namespace App\Jobs;

use App\Models\MemberAssignDeviceModel;
use App\Models\MemberModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class CustomJOb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        foreach ($this->data as $key => $value) {
//            $exist_member = MemberModel::where('member_id', $value->MemberId)->get()->count();
//            if ($exist_member == 0) {
//                if (strlen($value->MemberId) < 7 and !$value->RelationshipId) {
//                    echo $value->MemberId . '--';
//                    $member = new MemberModel();
//                    $member->member_id = $value->MemberId;
//                    $member->member_id_inputed = $value->MembershipId;
//                    $member->relationship_id = $value->RelationshipId;
//                    if (is_numeric($value->MemberIdType)) {
//                        $member->member_type = $value->MemberIdType;
//                    } else {
//                        $member->member_type = 3;
//                    }
//                    $member->privilege = '1,2,3,4,5';
//                    $member->rfid = $value->RFID;
//                    $member->fullname = $value->FullName;
//                    $member->ba_no = $value->MemberIdNo;
//                    $member->designation_id = 1011;
//                    $member->service_unit_id = 2;
//                    $member->address = $value->Address;
//                    $member->phone = $value->PhoneNo;
//                    if (!$this->checkemail($value->Email)) {
//                        $member->email = '';
//                    } else {
//                        $member->email = $value->Email;
//                    }
//                    $member->photo = $value->Photo;
//                    $member->signature = $value->Signature;
//                    $member->status = 1;
//                    $member->password = Hash::make(12345678);
//                    $member->isRetired = 0;
//                    $member->blood_group_id = 1;
//                    $member->save();
//                }
//            }
//        }


//        foreach ($this->data as $key => $data4) {
//            if (isset(explode("-", substr($data4, 16, 30))[2])) {
//                $relation = str_replace(' ', '', explode("-", substr($data4, 16, 30))[2]);
//            } else {
//                $relation = '';
//            }
//
//            $ba_no = str_replace(' ', '', substr($data4, 16, 18)) . $relation;
//            $badge_number = str_replace(' ', '', substr($data4, 5, 20));
//            $rfid = str_replace(' ', '', substr($data4, 5, 20));
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
//            echo $arrey_data[$key] = 'BadgeNumber:' . substr($data4, 5, 20) . ',  --- Ba no:' . $ba_no . ',  ---- card no:' . substr($data4, 508, 25) . '<br />';
//        }


//        foreach ($this->data as $key => $value) {
//            $exist_member = MemberModel::where('member_id', $value->member_id)->get()->count();
//            if ($exist_member == 0) {
//                $member = new MemberModel();
//                $member->member_id = $value->member_id;
//                $member->member_id_inputed = $value->member_id_inputed;
//                $member->member_type = $value->member_type;
//                $member->relationship_id = $value->relationship_id;
//                $member->parent_member_id = $value->parent_member_id;
//                $member->rfid = $value->rfid;
//                $member->fullname = $value->fullname;
//                $member->ba_no = $value->ba_no;
//                $member->designation_id = $value->designation_id;
//                $member->service_unit_id = $value->service_unit_id;
//                $member->address = $value->address;
//                $member->phone = $value->phone;
//                $member->email = $value->email;
//                $member->emergency_contact_no = $value->emergency_contact_no;
//                $member->blood_group_id = $value->blood_group_id;
//                $member->password = Hash::make(12345678);
//                $member->photo = $value->photo;
//                $member->signature = $value->signature;
//                $member->barcode = $value->barcode;
//                $member->qr_code = $value->qr_code;
//                $member->qr_code = $value->qr_code;
//                $member->army_qr_code_image = $value->army_qr_code_image;
//                $member->issue_date = $value->issue_date;
//                $member->expire_date = $value->expire_date;
//                $member->isRetired = $value->isRetired;
//                $member->dob = $value->dob;
//                $member->status = $value->status;
//                $member->created_at = $value->created_at;
//                $member->updated_at = $value->updated_at;
//                $member->privilege = '1,2,3,4,5';
//                $member->save();
//            }
//        }

        foreach ($this->data as $value) {
            $value->status = 1;
            $value->update();

            $assign_member_device = MemberAssignDeviceModel::where('member_id', $value->id)->get();
            foreach ($assign_member_device as $data) {
                $data->status = 1;
                $data->update();
            }
        }

//        foreach ($this->data as $value) {
//            $assign_member_device = MemberAssignDeviceModel::where('member_id', $value->id)->get();
//            foreach ($assign_member_device as $data) {
//                $data->status = 3;
//                $data->update();
//            }
//        }
    }

    private function find_member($ba_no)
    {
        return MemberModel::where('ba_no', $ba_no)->first();
    }

    function checkemail($str)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
}
