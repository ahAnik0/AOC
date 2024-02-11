<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffmemberModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Milon\Barcode\DNS1D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class StaffMemberController extends Controller
{

    function create()
    {
        return view('backend.staff_member.create_member');
    }

    public function index()
    {
        return view('backend.staff_member.all_member');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nid' => 'required',
            'dob' => 'required',
            'appointment' => 'required',
            'issue_date' => 'required',
            'expire_date' => 'required',
            'photo' => 'required|max:2048',
            'signature' => 'required|max:2048',
            'rfid' => 'required',
            'privilege' => 'required',
            'status' => 'required',
        ]);

        $photo = $request->file('photo');
        $sign = $request->file('signature');

        $photo_Name = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('uploads/staff_img'), $photo_Name);

        $sign_Name = time() . '.' . $sign->getClientOriginalExtension();
        $sign->move(public_path('uploads/staff_img'), $sign_Name);

        $member = new StaffmemberModel();
        $member->name = $request->name;
        $member->nid = $request->nid;
        $member->dob = $request->dob;
        $member->appointment = $request->appointment;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->photo = $photo_Name;
        $member->signature = $sign_Name;
        $member->rfid = $request->rfid;
        $member->privilege = implode(",", $request->privilege);
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->status = $request->status;
        $member->save();

        Toastr::success('Save Successfully', 'Saved');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = StaffmemberModel::query();
            $query->orderBy('id', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addColumn('photo', function ($data) {
                    $url = asset("uploads/staff_img/$data->photo");
                    return '<img src=' . $url . ' border="0" width="30" class="img-rounded" align="center"/>';
                })->addColumn('exp_date', function ($data) {
                    return Carbon::parse($data->expire_date)->format('M d, Y');
                })->addColumn('issue_date', function ($data) {
                    return Carbon::parse($data->issue_date)->format('M d, Y');
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-success">Active</span>';
                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<div class="btn-group" role="group">
                           <a href="' . url('admin/staffmember/edit/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button">Edit</a> <a class="btn btn-outline-danger btn-xs " type="button" href="javascript:void(0)" onclick="delete_member(' . $data->id . ')">Delete</a> <a href="' . url('admin/staffmember/id_card_print/font/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button" target="_blank">Font</a> <a href="' . url('admin/staffmember/id_card_print/back/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button" target="_blank">Back</a></div> ';
                    return $actionBtn;
                })->rawColumns(['photo', 'exp_date', 'issue_date', 'status', 'action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        $member = StaffmemberModel::find($id);
        File::delete(public_path('uploads/staff_img/' . $member->photo));
        File::delete(public_path('/uploads/staff_img/' . $member->signature));
        $member->delete();
        return response()->json(['success' => 'Done']);
    }

    public function edit($id)
    {
        $member = StaffmemberModel::find($id);
        return view('backend.staff_member.edit_member.edit_member', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nid' => 'required',
            'dob' => 'required',
            'appointment' => 'required',
            'issue_date' => 'required',
            'expire_date' => 'required',
            'photo' => 'max:2048',
            'signature' => 'max:2048',
            'rfid' => 'required',
            'privilege' => 'required',
            'status' => 'required',
        ]);

        $member = StaffmemberModel::find($id);

        $photo = $request->file('photo');
        $sign = $request->file('signature');

        if (isset($photo)) {
            File::delete(public_path('uploads/staff_img/' . $member->photo));
            $photo_Name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/staff_img'), $photo_Name);
        } else {
            $photo_Name = $member->photo;
        }

        if (isset($sign)) {
            File::delete(public_path('/uploads/staff_img/' . $member->signature));
            $sign_Name = time() . '.' . $sign->getClientOriginalExtension();
            $sign->move(public_path('uploads/staff_img'), $sign_Name);
        } else {
            $sign_Name = $member->signature;
        }

        $member->name = $request->name;
        $member->nid = $request->nid;
        $member->dob = $request->dob;
        $member->appointment = $request->appointment;
        $member->issue_date = $request->issue_date;
        $member->expire_date = $request->expire_date;
        $member->photo = $photo_Name;
        $member->signature = $sign_Name;
        $member->rfid = $request->rfid;
        $member->privilege = implode(",", $request->privilege);
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->status = $request->status;
        $member->update();

        Toastr::success('Save Successfully', 'Saved');
        return redirect()->back();
    }

    function id_card_print($position, $member_id)
    {
        $member = StaffmemberModel::find($member_id);
        if ($position == "font") {

            $qrcode = base64_encode(QrCode::format('svg')->generate($member->id . ', Name:' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'P. ADD:' . $member->address));

            $bar_code = DNS1D::getBarcodeHTML($member->id, "C128", 1.5, 33);

            $pdf = PDF::loadView('backend.staff_member.staff_id_card.id_card_front', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
            $pdf->setPaper('A4', '');
            return $pdf->stream($member->name . "_" . $member->id . "-" . str_pad($member->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
        } else {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->id . ',' . $member->fullname . ',' . 'Phone:' . $member->phone . ',' . 'P. ADD:' . $member->address));

            $bar_code = DNS1D::getBarcodeHTML($member->id, "C128", 1.5, 33);

            $pdf = PDF::loadView('backend.staff_member.staff_id_card.id_card_back', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
            $pdf->setPaper('A4', '');
            return $pdf->stream($member->name . "_" . $member->id . "-" . str_pad($member->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
        }
    }
}
