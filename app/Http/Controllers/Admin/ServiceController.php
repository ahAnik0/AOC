<?php

namespace App\Http\Controllers\Admin;

use App\Models\service;
// use Barryvdh\DomPDF\PDF;
use App\Models\SwimModel;
use App\Models\MemberModel;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class ServiceController extends Controller
{
    public function service_form($type)
    {
        return view('backend.service.new_service');
    }

    function submit_service_form(Request $request, $type)
    {
        request()->validate([
            'member_id' => 'required_without:new_member_name',
            'new_member_name' => 'required_without:member_id',
            'service_name' => 'required',
            'number_of_person' => 'required',
            //            'name_of_guests' => 'required',
            'amount' => 'required',
        ]);

        if (!$request->member_id) {
            $new_member = new MemberModel();
            $new_member->member_type = 4;
            $new_member->fullname = $request->new_member_name;
            $new_member->ba_no = $request->member_ba_no;
            $new_member->phone = $request->member_phone;
            $new_member->save();
        }

        $service = new service();
        $service->member_id = !$request->member_id ? $new_member->id : $request->member_id;
        $service->service_name = $type;
        $service->number_of_person = $request->number_of_person;
        $service->name_of_guests = isset($request->name_of_guests) ? implode(",", $request->name_of_guests) : '';
        $service->amount = $request->amount;
        $service->save();

        $member_id = !$request->member_id ? $new_member->id : $request->member_id;
        $member = MemberModel::find($member_id);
        if ($member->parent_member_id == null) {
            $parent_member = $member_id;
        } else {
            $parent_member = $member->parent_member->id;
        }

        $service_payment = new PaymentModel();
        $service_payment->member_id = $parent_member;
        $service_payment->type = $type;
        $service_payment->debit = 0;
        $service_payment->credit = $request->amount;
        $service_payment->ref_id = $service->id;
        $service_payment->created_by = $request->member_id;
        $service_payment->created_user_type = 'system';
        $service_payment->save();

        return redirect()->route('admin.service/service_receipt_print', $service->id);
    }

    function service_receipt_print($id)
    {
        $service = service::find($id);
        return view('backend.service.service_receipt_print', compact('service'));
        $pdf = PDF::loadView('backend.service.service_receipt_print', ["service" => $service]);
        $pdf->setPaper('A4', '');
        return $pdf->stream('file.pdf', array('Attachment' => 0));
    }

    function search_service_member(Request $request)
    {
        $query = $request->get('query');
        if (is_numeric($query) == 1 and ceil(log10($query)) > 7) {
            $query_1 = substr($query, -4);
            $query_2 = substr($query, -5);
        } else {
            $query_1 = $request->get('query');
            $query_2 = $request->get('query');
        }

        if ($query) {
            $data = MemberModel::query()
                ->where('member_type', '!==', 4)
                ->select('fullname', 'member_id_inputed', 'ba_no', 'phone', 'id')
                ->orwhere('fullname', 'like', '%' . $query . '%')
                ->orwhere('member_id_inputed', 'like', '%' . $query . '%')
                ->orwhere('ba_no', 'like', '%' . $query . '%')
                ->orwhere('ba_no', 'like', '%' . $query_1 . '%')
                ->orwhere('ba_no', 'like', '%' . $query_2 . '%')
                ->orwhere('phone', 'like', '%' . $query . '%')
                ->get();

            $output = '<ul class="list-group l-class" style="display: block;position: relative;width: 100%;font-size: 17px;font-weight: bold;line-height: 25px;border: 1px solid;cursor: pointer;">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item bg-success list" onclick=getcustomerdata(' . $row->id . ')>' . $row->fullname . '(ID:' . $row->member_id_inputed . ')</li>';
            }
            $output .= '</ul>';
            echo $output;
        }

        //        elseif ($query_1) {
        //            $data = MemberModel::query()
        //                ->where('member_type', '!==', 4)
        //                ->select('fullname', 'member_id_inputed', 'ba_no', 'phone', 'id')
        //                ->orwhere('fullname', 'like', '%' . $query_1 . '%')
        //                ->orwhere('member_id_inputed', 'like', '%' . $query_1 . '%')
        //                ->orwhere('ba_no', 'like', '%' . $query_1 . '%')
        //                ->orwhere('phone', 'like', '%' . $query_1 . '%')
        //                ->get();
        //
        //            $output = '<ul class="list-group l-class" style="display: block;position: relative;width: 100%;font-size: 17px;font-weight: bold;line-height: 25px;border: 1px solid;cursor: pointer;">';
        //            foreach ($data as $row) {
        //                $output .= '<li class="list-group-item bg-success list" onclick=getcustomerdata(' . $row->id . ')>' . $row->fullname . '(ID:' . $row->member_id_inputed . ')</li>';
        //            }
        //            $output .= '</ul>';
        //            echo $output;
        //        } elseif ($query_2) {
        //            $data = MemberModel::query()
        //                ->where('member_type', '!==', 4)
        //                ->select('fullname', 'member_id_inputed', 'ba_no', 'phone', 'id')
        //                ->orwhere('fullname', 'like', '%' . $query_2 . '%')
        //                ->orwhere('member_id_inputed', 'like', '%' . $query_2 . '%')
        //                ->orwhere('ba_no', 'like', '%' . $query_2 . '%')
        //                ->orwhere('phone', 'like', '%' . $query_2 . '%')
        //                ->get();
        //
        //            $output = '<ul class="list-group l-class" style="display: block;position: relative;width: 100%;font-size: 17px;font-weight: bold;line-height: 25px;border: 1px solid;cursor: pointer;">';
        //            foreach ($data as $row) {
        //                $output .= '<li class="list-group-item bg-success list" onclick=getcustomerdata(' . $row->id . ')>' . $row->fullname . '(ID:' . $row->member_id_inputed . ')</li>';
        //            }
        //            $output .= '</ul>';
        //            echo $output;
        //        }
    }

    function get_customer_data_for_service($id)
    {
        $member = MemberModel::select('members.*', 'serving_unit.name as serving_name', 'ranks.name as rank_name')->where('members.id', $id)->leftJoin(
            'serving_unit',
            'members.service_unit_id',
            '=',
            'serving_unit.id'
        )->leftJoin('ranks', 'members.designation_id', '=', 'ranks.id')->first();

        $due = SwimModel::where('member_id', $id)->sum('due');

        return response()->json(['member' => $member, 'previous_due' => $due]);
    }

    function service_report_index($type)
    {
        return view('backend.service.service_report.service_booking_history', compact('type'));
    }

    function service_report_search(Request $request)
    {
        if ($request->ajax()) {
            $query = service::query();

            if ($request->service_name !== 'no_value') {
                $query->where('service_name', $request->service_name);
            }

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            if ($request->member_name !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('fullname', 'like', '%' . $request->member_name . '%');
                });
            }

            if ($request->member_id !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('id', 'like', '%' . $request->member_id . '%');
                });
            }

            $query->orderBy('created_at', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return $data->member->fullname;
                })->addColumn('time', function ($data) {
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })->addColumn('date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->addColumn('action', function ($data) {
                    $actionBtn = '';
                    if ($data->remarks == null) {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs"  href="' . url('admin/service/service_receipt_print/' . $data->id) . '" target="_blank">Print</a> <a class="btn btn-danger btn-xs"  href="#" onclick="cancel(' . $data->id . ')">Cancel</a></div>';
                    } else {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs disabled"  >Cancel</a></div>';
                    }

                    return $actionBtn;
                })->with('sum', $query->sum('amount'))
                ->rawColumns(['member', 'time', 'date', 'action'])
                ->make(true);
        }
    }


    function cancel_service(Request $request)
    {
        request()->validate([
            'cancel_id' => 'required',
            'cancel_reason' => 'required',
        ]);

        $booking = service::find($request->cancel_id);
        $booking->remarks = $request->cancel_reason;
        $booking->amount = 0;
        $booking->update();

        PaymentModel::where('ref_id', $request->cancel_id)->delete();
        return response()->json(['success' => 'Done']);
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new SampleExport, 'sample.xlsx');
    // }

    public function generatePDF(Request $request)
    {
        if ($request->ajax()) {
            $query = service::query();

            if ($request->service_name !== 'no_value') {
                $query->where('service_name', $request->service_name);
            }

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            if ($request->member_name !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('fullname', 'like', '%' . $request->member_name . '%');
                });
            }

            if ($request->member_id !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('id', 'like', '%' . $request->member_id . '%');
                });
            }

            $query->orderBy('created_at', 'desc');

            return $query;
            

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return $data->member->fullname;
                })->addColumn('time', function ($data) {
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })->addColumn('date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->addColumn('action', function ($data) {
                    $actionBtn = '';
                    if ($data->remarks == null) {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs"  href="' . url('admin/service/service_receipt_print/' . $data->id) . '" target="_blank">Print</a> <a class="btn btn-danger btn-xs"  href="#" onclick="cancel(' . $data->id . ')">Cancel</a></div>';
                    } else {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs disabled"  >Cancel</a></div>';
                    }

                    return $actionBtn;
                })->with('sum', $query->sum('amount'))
                ->rawColumns(['member', 'time', 'date', 'action'])
                ->make(true);
        }



        // return $query;
        $pdf = PDF::loadView('backend.pdf.report_pdf', $query);

        return $pdf->stream('report_pdf');
    }
}
