<?php

namespace App\Http\Controllers\Admin\report;

use App\Http\Controllers\Controller;
use App\Models\AttLogModel;
use App\Models\EmplistDeviceModel;
use App\Models\MemberAssignDeviceModel;
use App\Models\MemberModel;
use App\Models\MovieBookingModel;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class ReportController extends Controller
{
    public function movie_ticketing_report_index()
    {
        return view('backend.report.movie_booking.all_booking');
    }

    function movie_ticketing_report_search(Request $request)
    {
        if ($request->ajax()) {
            $query = MovieBookingModel::query();

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            if ($request->movie_title !== null) {
                $query->whereHas('movie', function ($query2) use ($request) {
                    $query2->where('title', 'like', '%' . $request->movie_title . '%');
                });
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

            $query->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('membername', function ($data) {
                    return $data->member->fullname;
                })->addColumn('member_type', function ($data) {
                    $member_type = '';
                    if ($data->member->member_type == 4) {
                        $member_type = '<span class="right badge badge-secondary">Guest</span>';
                    } else {
                        $member_type = '<span class="right badge badge-success">Regular</span>';
                    }
                    return $member_type;
                })->addColumn('movie', function ($data) {
                    return $data->movie->title;
                })->addColumn('seat', function ($data) {
                    return strtoupper($data->seat->implode('seat_number', ','));
                })->addColumn('issue_date', function ($data) {
                    return Carbon::parse($data->date)->format('M d, Y');
                })->addColumn('action', function ($data) {
                    $actionBtn = '';
                    if ($data->remarks !== null) {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs disabled"  href="#">Canceled</a>
                   </div>';
                    } else {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs"  href="' . url('admin/movie/print_movie_ticket/' . $data->id) . '" target="_blank">Print</a>
<a class="btn btn-danger btn-xs"  href="#" onclick="cancel(' . $data->id . ')">Cancel</a>
                   </div>';
                    }
                    return $actionBtn;
                })->with('sum', $query->sum('amount'))
                ->rawColumns(['membername', 'member_type', 'movie', 'number_of_person', 'issue_date', 'action'])
                ->make(true);
        }
    }

    public function payment_history_index()
    {
        return view('backend.report.payment history.payment_history');
    }

    function payment_history_search(Request $request)
    {
        if ($request->ajax()) {
            $query = PaymentModel::query();

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
                    if ($data->member) {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs"  href="' . url('admin/member/member_profile' . $data->member->id) . '" target="_blank">' . $data->member->fullname . '</a></div>';
                    } else {
                        $actionBtn = '';
                    }
                    return $actionBtn;
                })->addColumn('date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->with('sum', $query->sum('credit'))
                ->rawColumns(['member', 'date', 'movie', 'number_of_person', 'issue_date', 'action'])
                ->make(true);
        }
    }

    //    public function att_index()
    //    {
    //        $today = Carbon::now()->toDateString();
    //        $tomorrow = Carbon::tomorrow()->toDateString();
    //        $query = AttLogModel::query()->whereBetween('authDate', [$today, $tomorrow])->get()->groupBy('badge_number');
    //        return view('backend.report.attendence_report.attendance_report', compact('query'));
    //    }
    //
    //    function att_search(Request $request)
    //    {
    //        if ($request->from_date !== null and $request->to_date !== null) {
    //            $today = $request->from_date;
    //            $tomorrow = $request->to_date;
    //        } else {
    //            $today = Carbon::now()->toDateString();
    //            $tomorrow = Carbon::tomorrow()->toDateString();
    //        }
    //        $query = AttLogModel::query()->whereBetween('authDate', [$today, $tomorrow])->get()->groupBy('badge_number');
    //        return view('backend.report.attendence_report.attendance_report', compact('query'));
    //    }


    function att_search(Request $request)
    {
        if ($request->ajax()) {
            $query = AttLogModel::query();

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('authDate', [$request->from_date, $request->to_date]);
            }

            if ($request->badge_number !== null) {
                $query->where('badge_number', 'like', '%' . $request->badge_number . '%');
            }

            if ($request->device_id !== null) {
                $query->where('device_id', $request->device_id);
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

            $query->orderBy('authDateTime', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return isset($data->member) ? $data->member->fullname : '';
                })->addColumn('auth_date', function ($data) {
                    return Carbon::parse($data->authDate)->format('M d, Y');
                })->addColumn('auth_time', function ($data) {
                    return Carbon::parse($data->authTime)->format('h:i:s A');
                })->addColumn('device', function ($data) {
                    return $data->device->device_name;
                })->addColumn('total_punch', function ($data) {
                    return total_authh_count($data->badge_number, $data->authDate, Carbon::parse($data->authDate)->addDays(1));
                })
                ->rawColumns(['member', 'auth_time', 'auth_date', 'total_punch', 'device'])
                ->make(true);
        }
    }


    //    private function member_name_from_emp_list($badge_number)
    //    {
    //        $emplist_data = EmplistDeviceModel::where('badge_number', $badge_number)->first();
    //        if (isset($emplist_data)) {
    //            $emplist_badge_number_id = $emplist_data->member_sl;
    //            $member_data = MemberModel::find($emplist_badge_number_id);
    //            if (isset($member_data)) {
    //                $member_name = $member_data->fullname;
    //            } else {
    //                $member_name = null;
    //            }
    //        } else {
    //            $member_name = null;
    //        }
    //        
    //        return $member_name;
    //    }

    public function att_index()
    {
        return view('backend.report.attendence_report.attendance_report');
    }

    function emplist_show()
    {
        return view('backend.report.emp_list_device.attendance_report');
    }

    function emplist_search(Request $request)
    {
        if ($request->ajax()) {
            $query = EmplistDeviceModel::query();

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            if ($request->badge_number !== null) {
                $query->where('badge_number', 'like', '%' . $request->badge_number . '%');
            }

            if ($request->member_name !== null) {
                $query->where('Name', 'like', '%' . $request->member_name . '%');
            }

            if ($request->rfid !== null) {
                $query->where('CardId', 'like', '%' . $request->rfid . '%');
            }

            if ($request->device_id !== null) {
                $query->where('devId', $request->device_id);
            }

            $query->orderBy('created_at', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return memberSearchWithBadgeNumber($data->badge_number);
                })->addColumn('auth_date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->addColumn('auth_time', function ($data) {
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })->addColumn('device', function ($data) {
                    return $data->device->device_name;
                })
                ->rawColumns(['member', 'auth_time', 'auth_date', 'device'])
                ->make(true);
        }
    }

    function member_assign_device_show()
    {
        return view('backend.report.member_assign_device.attendance_report');
    }

    function member_assign_device_search(Request $request)
    {
        if ($request->ajax()) {
            $query = MemberAssignDeviceModel::query();

            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            if ($request->badge_number !== null) {
                $query->where('badge_number', 'like', '%' . $request->badge_number . '%');
            }

            if ($request->member_name !== null) {
                $query->where('Name', 'like', '%' . $request->member_name . '%');
            }

            if ($request->rfid !== null) {
                $query->where('CardId', 'like', '%' . $request->rfid . '%');
            }

            if ($request->device_id !== null) {
                $query->where('device_id', $request->device_id);
            }

            $query->orderBy('created_at', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return $data->member ? $data->member->fullname : $data->member2->fullname;
                })->addColumn('auth_date', function ($data) {
                    return Carbon::parse($data->created_at)->format('M d, Y');
                })->addColumn('auth_time', function ($data) {
                    return Carbon::parse($data->created_at)->format('h:i:s A');
                })->addColumn('device', function ($data) {
                    return $data->device->device_name;
                })
                ->rawColumns(['member', 'auth_time', 'auth_date', 'device'])
                ->make(true);
        }
    }
    function member_device_managment()
    {
        return view('backend.report.device_managment.device_managment_control');
    }

    function member_assign_device_delete(Request $r)
    {
        $countDeleted = MemberAssignDeviceModel::where('device_id', $r->device_id)->delete();

        return back()->with('success', "Successfully deleted $countDeleted Records.");
    }

    function member_assign_device_reload(Request $r)
    {
        $activeMembers = MemberModel::where('status', 1)->get();
        $recordsCreated = 0;
        
        foreach ($activeMembers as $member) {
            MemberAssignDeviceModel::create([
                'member_id' => $member->member_id,
                'device_id' => $r->device_id,
                'card_id' => $member->rfid,
                'status' => '1',
            ]);
            
            $recordsCreated++;
        }
        
        return back()->with('success', "Successfully saved $recordsCreated records.");
    }
}
