<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodGroupModel;
use App\Models\Contact;
use App\Models\DeviceModel;
use App\Models\MemberAssignDeviceModel;
use App\Models\MemberModel;
use App\Models\PaymentModel;
use App\Models\rank;
use App\Models\RelationshipModel;
use App\Models\ServingeUnitModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Milon\Barcode\DNS1D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class MemberController extends Controller
{
    function create_member()
    {
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        return view('backend.member.create_member', compact('ranks', 'serving_units', 'blood_groups'));
    }

    function store_member(Request $request)
    {
        request()->validate([
            'member_type' => 'required',
            'privilege' => 'required',
            'ba_no' => 'nullable|unique:members,ba_no',
            'service_unit_id' => 'required',
            'fullname' => 'required',
            'member_id_inputed' => 'required|unique:members,member_id_inputed',
            'designation_id' => 'required',
            'isRetired' => 'required',
            'issue_date' => 'required',
//            'expire_date' => 'required',
            'connection_to' => 'required',
//            'rfid' => 'required',
            'phone' => 'required',
//            'email' => 'required|unique:members,email',
//            'address' => 'required',
//            'dob' => 'required',
            'blood_group_id' => 'required',
            'status' => 'required',
        ]);

        $member = new MemberModel();
        $member->member_type = $request->member_type;
        $member->ba_no = strtoupper($request->ba_no);
        $member->privilege = implode(",", $request->privilege);
        $member->member_id_inputed = $request->member_id_inputed;
        $member->member_id = $request->member_id_inputed;
        $member->service_unit_id = $request->service_unit_id;
        $member->fullname = $request->fullname;
        $member->designation_id = $request->designation_id;
        $member->parent_member_id = $request->parent_member_id;
        $member->relationship_id = $request->relationship_id;
        $member->isRetired = $request->isRetired;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->rfid = $request->rfid;
        $member->phone = $request->phone;
        $member->emergency_contact_no = $request->emergency_contact_no;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->dob = $request->dob;
        $member->blood_group_id = $request->blood_group_id;
        $member->badge_number = $request->badge_number;
        $member->rfid2 = $request->rfid2;
        $member->status = $request->status;
        $member->connection_to = $request->connection_to;
        $member->password = Hash::make(12345678);
        $member->save();


        $total_device = DeviceModel::all();
        foreach ($total_device as $data) {
            $assign = new MemberAssignDeviceModel();
            $assign->member_id = $member->id;
            $assign->device_id = $data->id;
            $assign->card_id = $member->rfid;
            $assign->status = 1;
            $assign->save();
        }

        return response()->json(['success' => 'Done', 'member_id' => $member->id]);
    }

    function store_relational_member(Request $request)
    {
        request()->validate([
            'member_type' => 'required',
            'relationship_id' => 'required',
            'ba_no' => 'nullable|unique:members,ba_no',
            'service_unit_id' => 'required',
            'fullname' => 'required',
            'member_id_inputed' => 'required|unique:members,member_id_inputed',
            'designation_id' => 'required',
            'isRetired' => 'required',
            'issue_date' => 'required',
//            'expire_date' => 'required',
//            'connection_to' => 'required',
//            'rfid' => 'required',
            'phone' => 'required',
//            'address' => 'required',
            'dob' => 'required',
            'blood_group_id' => 'required',
            'status' => 'required',
        ]);

        $check_parent_member_relation = MemberModel::where('parent_member_id', $request->parent_member_id)->where('relationship_id', $request->relationship_id)->count();
        if ($check_parent_member_relation > 0) {
            return response()->json(['error' => 'This member already has this relationship ,plz choose another relationship']);
        }

        $member = new MemberModel();
        $member->member_type = $request->member_type;
        $member->ba_no = strtoupper($request->ba_no);
        $member->member_id_inputed = $request->member_id_inputed;
        $member->member_id = $request->member_id_inputed;
        $member->service_unit_id = $request->service_unit_id;
        $member->fullname = $request->fullname;
        $member->designation_id = $request->designation_id;
        $member->parent_member_id = $request->parent_member_id;
        $member->relationship_id = $request->relationship_id;
        $member->isRetired = $request->isRetired;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->rfid = $request->rfid;
        $member->badge_number = $request->badge_number;
        $member->rfid2 = $request->rfid2;
        $member->phone = $request->phone;
        $member->emergency_contact_no = $request->emergency_contact_no;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->dob = $request->dob;
        $member->blood_group_id = $request->blood_group_id;
        $member->status = $request->status;
        $member->password = Hash::make(12345678);
        $member->save();

        $total_device = DeviceModel::all();
        foreach ($total_device as $data) {
            $assign = new MemberAssignDeviceModel();
            $assign->member_id = $member->id;
            $assign->device_id = $data->id;
            $assign->card_id = $member->rfid;
            $assign->status = 1;
            $assign->save();
        }

        return response()->json(['success' => 'Done', 'member_id' => $member->id]);
    }

    function store_file_form($member_id)
    {
        $member_type = MemberModel::find($member_id)->member_type;
        return view('backend.member.member_file_form', compact('member_type', 'member_id'));
    }

    public function signature_upload(Request $request)
    {
        $rules = array(
            'file' => 'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $name = time() . '.' . request()->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads/member_sigh'), $name);

        $output = array(
            'success' => 'Image uploaded successfully',
            'image' => '<img src="' . asset('uploads/member_sigh') . '/' . $name . '" class="img-thumbnail" style="height:100px;margin-top:-20px"/>',
            'file_name' => $name,
        );

        return response()->json($output);
    }

    public function passport_photo_upload(Request $request)
    {
        $rules = array(
            'file' => 'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $name = time() . '.' . request()->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads/member_Photograph'), $name);

        $output = array(
            'success' => 'Image uploaded successfully',
            'image' => '<img src="' . asset('uploads/member_Photograph') . '/' . $name . '" class="img-thumbnail" style="height:100px;margin-top:-20px"/>',
            'file_name' => $name,
        );

        return response()->json($output);
    }

    public function qr_code_upload(Request $request)
    {
        $rules = array(
            'file' => 'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $name = time() . '.' . request()->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads/member_qu_code'), $name);

        $output = array(
            'success' => 'Image uploaded successfully',
            'image' => '<img src="' . asset('uploads/member_qu_code') . '/' . $name . '" class="img-thumbnail" style="height:100px;margin-top:-20px"/>',
            'file_name' => $name,
        );

        return response()->json($output);
    }

    function store_file(Request $request, $id)
    {
        request()->validate([
            'photograph_file_name' => 'required',
            'sign_file_name' => 'required',
        ]);

        $other_file = MemberModel::find($id);
        $other_file->photo = $request->photograph_file_name;
        $other_file->signature = $request->sign_file_name;
        $other_file->army_qr_code_image = $request->qr_code_file_name;
        $other_file->update();

        return response()->json(['success' => 'Done']);
    }


    function all_member()
    {
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        return view('backend.member.all_member', compact('ranks', 'serving_units', 'blood_groups'));
    }

    function all_member_search(Request $request)
    {

        if ($request->ajax()) {
            $query = MemberModel::query();

            if ($request->ba_no !== null) {
                $query->where('ba_no', 'like', '%' . $request->ba_no . '%');
            }

            if ($request->member_type == null) {
                $query->where('member_type', '!=', 4);
            }

            if ($request->member_type !== null) {
                $query->where('member_type', $request->member_type);
            }

            if ($request->member_id_inputed !== null) {
                $query->where('member_id_inputed', 'like', '%' . $request->member_id_inputed . '%');
            }

            if ($request->name !== null) {
                $query->where('fullname', 'like', '%' . $request->name . '%');
            }

            if ($request->phone !== null) {
                $query->where('phone', 'like', '%' . $request->phone . '%');
            }

            if ($request->email !== null) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->status !== null) {
                $query->where('status', $request->status);
            }

            if ($request->designation_id !== null) {
                $query->whereHas('designation', function ($query2) use ($request) {
                    $query2->where('id', $request->designation_id);
                });
            }

            if ($request->blood_group_id !== null) {
                $query->whereHas('blood_group', function ($query2) use ($request) {
                    $query2->where('id', $request->blood_group_id);
                });
            }

            $query->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('photo', function ($data) {
                    $url = asset("uploads/member_Photograph/$data->photo");
                    return '<img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
                })->addColumn('designation', function ($data) {
                    $designation = '';
                    if ($data->member_type !== 4) {
                        $designation = $data->designation->name;
                    } else {
                        $designation = '<span class="right badge badge-info">Guest User</span>';
                    }
                    return $designation;
                })->addColumn('exp_date', function ($data) {
                    return Carbon::parse($data->connection_to)->format('M d, Y');
                })->addColumn('member_id_inputed', function ($data) {
                    $member_id_inputed = '';
                    if ($data->member_type == 4) {
                        $member_id_inputed = '<span class="right badge badge-info">Guest User</span>';
                    } else {
                        $member_id_inputed = $data->member_id_inputed;
                    }
                    return $member_id_inputed;
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-success">Active</span>';
                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
//                    $edit_button = " <a href="' . url('admin/member/edit_member/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button">Edit</a>";
                    if ($data->member_type !== 4 and $data->parent_member_id == null) {
                        $button = '<a href="' . url('admin/member/member_profile/' . $data->id) . '" class="btn btn-outline-secondary btn-xs" type="button">View</a> <a href="' . url('admin/member/edit_member/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button">Edit</a>';
                    } else {
                        $button = '<a href="' . url('admin/member/guest_id_card_print/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button" target="_blank">Font</a> <a href="' . url('admin/member/id_card_back/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button" target="_blank">Back</a>';
                    }
                    $actionBtn = '<div class="btn-group" role="group">
                           ' . $button . ' <a class="btn btn-outline-danger btn-xs " type="button" href="javascript:void(0)" onclick="delete_member(' . $data->id . ')">Delete</a>
                        </div>
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['photo', 'designation', 'status', 'member_id_inputed', 'action'])
                ->make(true);
        }
    }

    function id_card_front($member_id)
    {
        $member = MemberModel::find($member_id);
        if ($member->parent_member_id) {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'NOK:' . $member->parent_member->fullname . ',' . 'P ADD:' . $member->address));
        } else {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'P. ADD:' . $member->address));
        }

        $bar_code = DNS1D::getBarcodeHTML($member->ba_no, "C128", 1.5, 33);

        $pdf = PDF::loadView('backend.id_card_print.id_card_front', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($member->fullname . "_" . $member->member_id_inputed . "-" . str_pad($member->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    function guest_id_card_print($member_id)
    {
        $member = MemberModel::find($member_id);
        if ($member->parent_member_id) {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'NOK:' . $member->parent_member->fullname . ',' . 'P ADD:' . $member->address));
        } else {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'P. ADD:' . $member->address));
        }

        $bar_code = DNS1D::getBarcodeHTML($member->ba_no, "C128", 1.5, 33);

        $pdf = PDF::loadView('backend.id_card_print.id_card_front_guest', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($member->fullname . "_" . $member->member_id_inputed . "-" . str_pad($member->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    function id_card_back($member_id)
    {
        $member = MemberModel::find($member_id);
        if ($member->parent_member_id) {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'NOK:' . $member->parent_member->fullname . ',' . 'P ADD:' . $member->address));
        } else {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'P. ADD:' . $member->address));
        }

        $bar_code = DNS1D::getBarcodeHTML($member->ba_no, "C128", 1.5, 33);

        $pdf = PDF::loadView('backend.id_card_print.id_card_back', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($member->fullname . "_" . $member->member_id_inputed . "-" . str_pad($member->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    function delete_member($member_id)
    {
        $member = MemberModel::find($member_id);
        File::delete(public_path('uploads/member_Photograph/' . $member->photo));
        File::delete(public_path('/uploads/member_sigh/' . $member->signature));
        File::delete(public_path('/uploads/member_qu_code/' . $member->army_qr_code_image));
        MemberModel::where('parent_member_id', $member_id)->delete();
   // update assign device table set status=3 where member =???
//        $total_device = DeviceModel::all();
//        foreach ($total_device as $data) {
//            $assign = new MemberAssignDeviceModel();
//            $assign->member_id = $member->id;
//            $assign->device_id = $data->id;
//            $assign->status = 3;
//            $assign->save();
//        }
        $member->delete();

        return response()->json(['success' => 'Done']);
    }

    function delete_relational_member($member_id)
    {
        $member = MemberModel::find($member_id);
        File::delete(public_path('uploads/member_Photograph/' . $member->photo));
        File::delete(public_path('/uploads/member_sigh/' . $member->signature));
        File::delete(public_path('/uploads/member_qu_code/' . $member->army_qr_code_image));
        $member->delete();

        $total_device = DeviceModel::all();
        foreach ($total_device as $data) {
            $assign = new MemberAssignDeviceModel();
            $assign->member_id = $member->id;
            $assign->device_id = $data->id;
            $assign->status = 3;
            $assign->save();
        }

        Toastr::success('Deleted Successfully', '');
        return redirect()->back();
    }

    function edit_member($id)
    {
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        $relationship = RelationshipModel::all();
        $member = MemberModel::find($id);
        return view('backend.member.edit_member.edit_member', compact('ranks', 'serving_units', 'blood_groups', 'relationship', 'member'));
    }

    function update_member_info(Request $request, $member_id)
    {

        request()->validate([
            "member_type" => "required",
            "ba_no" => "required|unique:members,ba_no,$member_id,id",
            "service_unit_id" => "required",
            'privilege' => 'required',
            "fullname" => "required",
            'designation_id' => 'required',
            'member_id_inputed' => "required|unique:members,member_id_inputed,$member_id,id",
            'isRetired' => 'required',
            'issue_date' => 'required',
//            'expire_date' => 'required',
//            'rfid' => 'required',
            'phone' => 'required',
//            "email" => "required",
//            'address' => 'required',
//            'dob' => 'required',
            'blood_group_id' => 'required',
            'connection_to' => 'required',
            'status' => 'required',
        ]);

        $member = MemberModel::find($member_id);
        $member->member_type = $request->member_type;
        $member->privilege = implode(",", $request->privilege);
        $member->member_id_inputed = $request->member_id_inputed;
        $member->member_id = $request->member_id_inputed;
        $member->ba_no = $request->ba_no;
        $member->service_unit_id = $request->service_unit_id;
        $member->fullname = $request->fullname;
        $member->designation_id = $request->designation_id;
        $member->isRetired = $request->isRetired;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->rfid = $request->rfid;
        $member->badge_number = $request->badge_number;
        $member->rfid2 = $request->rfid2;
        $member->phone = $request->phone;
        $member->emergency_contact_no = $request->emergency_contact_no;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->dob = $request->dob;
        $member->blood_group_id = $request->blood_group_id;
        $member->status = $request->status;
        $member->connection_to = $request->connection_to;
        $member->update();

        $member_relation = MemberModel::where('parent_member_id', $member_id)->get();
        foreach ($member_relation as $data) {
            $data->member_id_inputed = $member->member_id_inputed . $data->relationship->abbrivation;
            $data->member_id = $member->member_id_inputed . $data->relationship->abbrivation;
            $data->ba_no = $member->ba_no . $data->relationship->abbrivation;
            $data->update();
        }
        
        $existing_rfid = false;
        if ($member->rfid == $request->rfid) {
            $existing_rfid = true;
        }
        if (!$existing_rfid or $request->status == 0) {

            $assign_member_device = MemberAssignDeviceModel::where('member_id', $member_id)->get();
            foreach ($assign_member_device as $data) {
                $data->status = 3;
                $data->update();
            }
        } else {
            $total_device = DeviceModel::all();
            foreach ($total_device as $data) {
                $assign = new MemberAssignDeviceModel();
                $assign->member_id = $member->id;
                $assign->device_id = $data->id;
                $assign->card_id = $member->rfid;
                $assign->status = 1;
                $assign->save();
            }
        }

        return response()->json(['success' => 'Done', 'member_id' => $member->id]);
    }

    function edit_member_file($member_id)
    {
        $member = MemberModel::find($member_id);
        return view('backend.member.edit_member.edit_member_file', compact('member'));
    }

    function update_member_file(Request $request, $member_id)
    {
        $member = MemberModel::find($member_id);
        $request->photograph_file_name !== $member->photo ? File::delete(public_path('uploads/member_Photograph/' . $member->photo)) : '';
        $request->sign_file_name !== $member->signature ? File::delete(public_path('/uploads/member_sigh/' . $member->signature)) : '';
        $request->qr_code_file_name !== $member->army_qr_code_image ? File::delete(public_path('/uploads/member_qu_code/' . $member->army_qr_code_image)) : '';

        $member_id = $member->parent_member_id ? $member->parent_member->id . $member->relationship->abbrivation : $member->id;

        $member->member_id = $member_id;
        $member->photo = $request->photograph_file_name;
        $member->signature = $request->sign_file_name;
        $member->army_qr_code_image = $request->qr_code_file_name;
        $member->update();

        return response()->json(['success' => 'Done']);
    }

    function member_profile($member_id)
    {
        
        $member = MemberModel::find($member_id);
        $relation = MemberModel::where('parent_member_id', $member_id)->get();

        if ($member->connection_to) {
            $total_due = Carbon::now()->diffInMonths($member->connection_to);
        } else {
            $total_due = '';
        }

        $payment_history = PaymentModel::where('member_id', $member_id)->orderBy('id_payment_key', 'DESC')->get();

        return view('backend.member.view_member.member_profile', compact('member', 'relation', 'total_due', 'payment_history'));
    }

    function create_relational_member()
    {
        $parent_member = MemberModel::select('id', 'fullname')->where('member_type', 1)->get();
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        $relationship = RelationshipModel::all();
        return view('backend.member.relational_member.create_relational_member', compact('ranks', 'serving_units', 'blood_groups', 'relationship', 'parent_member'));
    }

    function relational_member_search(Request $request)
    {
        $member = MemberModel::where('member_id_inputed', $request->member_inputed_id)->first();

        return response()->json(['member' => $member]);
    }


    function relational_member_edit($id)
    {
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        $relationship = RelationshipModel::all();
        $member = MemberModel::find($id);
        return view('backend.member.relational_member.edit_relational_member', compact('ranks', 'serving_units', 'blood_groups', 'relationship', 'member'));
    }


    function relational_member_update(Request $request, $member_id)
    {
        request()->validate([
            'member_type' => 'required',
            'relationship_id' => 'required',
            "ba_no" => "required|unique:members,ba_no,$member_id,id",
            'service_unit_id' => 'required',
            'fullname' => 'required',
            'member_id_inputed' => "required|unique:members,member_id_inputed,$member_id,id",
            'designation_id' => 'required',
            'isRetired' => 'required',
            'issue_date' => 'required',
//            'expire_date' => 'required',
//            'rfid' => 'required',
            'phone' => 'required',
//            'address' => 'required',
//            'dob' => 'required',
            'blood_group_id' => 'required',
            'status' => 'required',
        ]);

        $check_parent_member_relation = MemberModel::where('parent_member_id', $request->parent_member_id)->where('relationship_id', $request->relationship_id)->count();
        if ($check_parent_member_relation > 1) {
            return response()->json(['error' => 'This member already has this relationship ,plz choose another relationship']);
        }

        $member = MemberModel::find($member_id);
        $member->member_type = $request->member_type;
        $member->ba_no = strtoupper($request->ba_no);
        $member->member_id = $request->member_id_inputed;
        $member->member_id_inputed = $request->member_id_inputed;
        $member->service_unit_id = $request->service_unit_id;
        $member->fullname = $request->fullname;
        $member->designation_id = $request->designation_id;
        $member->parent_member_id = $request->parent_member_id;
        $member->relationship_id = $request->relationship_id;
        $member->isRetired = $request->isRetired;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->rfid = $request->rfid;
        $member->badge_number = $request->badge_number;
        $member->rfid2 = $request->rfid2;
        $member->phone = $request->phone;
        $member->emergency_contact_no = $request->emergency_contact_no;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->dob = $request->dob;
        $member->blood_group_id = $request->blood_group_id;
        $member->status = $request->status;
        $member->update();


        $existing_rfid = false;
        if ($member->rfid == $request->rfid) {
            $existing_rfid = true;
        }
        if (!$existing_rfid or $request->status == 0) {

            $assign_member_device = MemberAssignDeviceModel::where('member_id', $member_id)->get();
            foreach ($assign_member_device as $data) {
                $data->status = 3;
                $data->update();
            }
        } else {
            $total_device = DeviceModel::all();
            foreach ($total_device as $data) {
                $assign = new MemberAssignDeviceModel();
                $assign->member_id = $member->id;
                $assign->device_id = $data->id;
                $assign->card_id = $member->rfid;
                $assign->status = 1;
                $assign->save();
            }
        }

        return response()->json(['success' => 'Done', 'member_id' => $member->id]);
    }

    function create_guest_from()
    {
        return view('backend.member.create_guest_member');
    }

    function submit_guest_from(Request $request)
    {
        request()->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:members,email',
            'privilege' => 'required',
            'address' => 'required',
        ]);

        $member = new MemberModel();
        $member->member_type = 4;
        $member->fullname = $request->fullname;
        $member->privilege = implode(",", $request->privilege);
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->password = Hash::make(12345678);
        $member->save();

        return redirect()->route('admin.member/all_member');
    }

    function manual_bill_payment(Request $request, $member_id)
    {
        $member = MemberModel::find($member_id);

        if ($member->payment_history) {

        }
        $service_payment = new PaymentModel();
        $service_payment->member_id = $member_id;
        $service_payment->type = 'monthly_payment';
        $service_payment->debit = 0;
        $service_payment->credit = $request->amount;
        $service_payment->ref_id = $member_id;
        $service_payment->pay_type = $request->pay_type;
        $service_payment->month = $request->month;
        $service_payment->chq_no = $request->chq_no;
        $service_payment->created_by = admin_id();
        $service_payment->created_user_type = 'system';
        $service_payment->save();

        $member->connection_to = now();
        $member->save();

        Toastr::success('Paid Successfully', '');
        
        return view('backend.member.payment_receipt_print', compact('member','request'));
    }
    // function payment_receipt_print($id)
    // {
    //     return $id;
    //     $member = MemberModel::find($id);
    //     return view('backend.member.payment_receipt_print', compact('member'));
    // }


    function member_receipt_print($id)
    {
        // return $id;
        $data = PaymentModel::where('id_payment_key',$id)->first();
        $member = MemberModel::find($data->member_id);
        // return $member;
        
        return view('backend.member.member_receipt_print', compact('member','data'));
    }


    public function change_member_password(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|string|min:3',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password needs to have at least 6 characters',
            'password_confirmation.required' => 'Passwords do not match'
        ]);

        $member = MemberModel::find($id);
        if ($request->input('password')) {
            $member->password = bcrypt($request->input('password'));
            $member->update();
            Toastr::success('Password Save Successfully', 'Changed');
            return redirect()->back();
        } else {
            Toastr::error('Please enter correct current password', 'Wrong');
            return redirect()->back();
        }
    }

}
