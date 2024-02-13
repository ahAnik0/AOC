<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\HallBookingModel;
use App\Models\ServingeUnitModel;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AdditionalCharge;
use App\Models\AditionalChrage;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class HallBookingController extends Controller
{
    public function index()
    {
        return view('backend.hall_booking.hall_booking');
    }

    function create_bokking_form(Request $request)
    {
        $selectedDate = $request->query('selectedDate');

        return view('backend.hall_booking.create_booking.new_booking', compact('selectedDate'));
    }

    public function store_event(Request $request)
    {
        // return $request;
        $member = MemberModel::find($request->member_id);
        $request->validate([
            'date' => 'required',
            'member_name' => 'required',
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($request->status == 1) {
            $color = 'red';
        } elseif ($request->status == 2) {
            $color = 'blue';
        } else {
            $color = 'green';
        }

        $request->request->add(['color' => $color, 'hall' => implode(",", $request->hall)]);
        HallBookingModel::create($request->all());

        Toastr::success('Save Successfully', 'Saved');

        if ($request->status == 2 || $request->status == 3) {
            return view('backend.hall_booking.create_booking.booking_payment_receipt_print', compact('member', 'request'));
        } else {
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = HallBookingModel::query();
            if ($request->from_date !== null and $request->to_date !== null) {
                $query->whereBetween('date', [$request->from_date, $request->to_date]);
            }
            if ($request->member_id !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('id', 'like', '%' . $request->member_id . '%');
                });
            }
            if ($request->member_name !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('full_name', 'like', '%' . $request->member_name . '%');
                });
            }
            if ($request->ba_no !== null) {
                $query->whereHas('member', function ($query2) use ($request) {
                    $query2->where('ba_no', 'like', '%' . $request->ba_no . '%');
                });
            }
            $query->orderBy('id', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('booking_date', function ($data) {
                    $data = Carbon::parse($data->created_at)->format('M d, Y');
                    return $data;
                })->addColumn('date', function ($data) {
                    $data = Carbon::parse($data->date)->format('M d, Y');
                    return $data;
                })->addColumn('shift', function ($data) {
                    $shift = '';
                    if ($data->shift == 0) {
                        $shift = 'Day';
                    } else {
                        $shift = 'Night';
                    }
                    return $shift;
                })->addColumn('ba_no', function ($data) {
                    return $data->member_id ? $data->member->ba_no : '';
                })->addColumn('rank', function ($data) {
                    return $data->member_id ? $data->member->designation->short_name : '';
                })->addColumn('name', function ($data) {
                    return $data->member_id ? $data->member->fullname : '';
                })->addColumn('mobile', function ($data) {
                    return $data->member_id ? $data->member->phone : '';
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-secondary">Temporary</span>';
                    } elseif ($data->status == 2) {
                        $status = '<span class="right badge badge-danger">Due</span>';
                    } elseif ($data->status == 3) {
                        $status = '<span class="right badge badge-success">paid</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="edit btn btn-outline-danger btn-sm" onclick="delete_data(' . $data->id . ')"><i class="fa fa-trash"></i></a> 
                    <a href="' . url('admin/hall_booking/edit_event/' . $data->id) . '" class="edit btn btn-outline-success btn-sm" ><i class="fa fa-edit"></i></a> 
                    <a href="' . url('admin/hall_booking/charge_event/' . $data->id) . '" class="edit btn btn-outline-warning btn-sm" ><i class="fa fa-plus"></i></a> 
                    <a href="' . url('admin/hall_booking/print_charge_event/' . $data->id) . '" class="edit btn btn-outline-info btn-sm" ><i class="fa fa-print"></i></a>';
                    return $actionBtn;
                })->with('sum', $query->sum('amount'))
                ->rawColumns(['date', 'details', 'status', 'action', 'ba_no', 'booking_date', 'name', 'rank'])
                ->make(true);
        }
    }
    public function charge_event($id)
    {

        $charge = AdditionalCharge::where('booking_id', $id)->first();
        $event_date = HallBookingModel::find($id);
        return view('backend.hall_booking.edit_booking.charge_event_booking', compact('event_date', 'charge'));
    }

    public function store_charge_event(Request $request)
    {

        $request->validate([
            'hall_rent' => 'required',
        ]);
        $charge = AdditionalCharge::where('booking_id', $request->booking_id)->first();

        if (!empty($charge)) {

            AdditionalCharge::find($request->chrg_id)->update($request->all());
            return redirect()->route('admin.hall_booking/index')->with('success', 'Done');
        } else {
            AdditionalCharge::create($request->all());
            return redirect()->route('admin.hall_booking/index')->with('success', 'Done');
        }
    }

    function print_charge_event($id)
    {
        $mm = HallBookingModel::find($id);
        $member = MemberModel::find($mm->member_id);
        $charge = AdditionalCharge::where('booking_id', $id)->first();
        if (!empty($charge)) {

            return view('backend.hall_booking.edit_booking.print_charge_event', compact('member', 'charge'));
        } else {

            return redirect()->back()->with('error', 'Please Enter Additional Charge');
        }
    }
    public function delete_event($id)
    {
        HallBookingModel::find($id)->delete();
        return response()->json(['success' => 'Done']);
    }

    public function edit_event($id)
    {
        $event_date = HallBookingModel::find($id);
        return view('backend.hall_booking.edit_booking.edit_booking', compact('event_date'));
    }

    public function update_event(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($request->status == 1) {
            $color = 'red';
        } elseif ($request->status == 2) {
            $color = 'blue';
        } else {
            $color = 'green';
        }
        $request->request->add(['color' => $color]);
        HallBookingModel::find($request->edit_id)->update($request->all());

        return redirect()->route('admin.hall_booking/index')->with('success', 'Done');
    }

    function calender_view()
    {

        return view('backend.hall_booking.calendar.calendar');
    }

    function calendar_data(Request $request)
    {
        if ($request->ajax()) {
            $hallBookings = HallBookingModel::all();
            $data = $hallBookings->map(function ($booking) {
                return [
                    'title' => $booking->title,
                    'start' => $booking->date,
                    'end'   => $booking->date,
                    'hall'  => $booking->hall,
                    'shift'  => $booking->shift
                ];
            });

            return response()->json($data);
        }


        return view('backend.hall_booking.calendar.calendar');
    }

    // public function calendarEvents(Request $request)
    // {
    //     return $request;
    //     switch ($request->type) {
    //         case 'create':
    //             $event = HallBookingModel::create([
    //                 'title' => $request->title,
    //                 'start' => $request->start,
    //                 'end' => $request->end,
    //             ]);

    //             return response()->json($event);
    //             break;

    //         case 'edit':
    //             $event = HallBookingModel::find($request->id)->update([
    //                 'title' => $request->title,
    //                 'start' => $request->start,
    //                 'end' => $request->end,
    //             ]);

    //             return response()->json($event);
    //             break;

    //         case 'delete':
    //             $event = HallBookingModel::find($request->id)->delete();

    //             return response()->json($event);
    //             break;

    //         default:
    //             # ...
    //             break;
    //     }
    // }

    function check_date(Request $request)
    {
        $hall = $request->hall;
        $counter = 0;
        
        foreach ($hall as $hall_data) {
            $date = null; 
            try {
                $date = HallBookingModel::where('hall', $hall_data)
                    ->where('shift', $request->shift)
                    ->whereDate('date', $request->date)
                    ->first();
            } catch (\Exception $e) {
                Log::error("Database query failed: " . $e->getMessage());
            }
    
            if ($date) {
                $counter++;
            }
        }
    
        if ($counter == 0) {
            return response()->json(['status' => 'available']);
        }
        return response()->json(['status' => 'not_available']);
    }

    function edit_check_date(Request $request)
    {
        $hall = $request->hall;
        $counter = 0;
        foreach ($hall as $hall_data) {
            $date = HallBookingModel::where('hall', $hall_data)->whereDate('date', $request->date)->first();
            if ($date) {
                $counter++;
            }
        }
        if ($counter == 0) {
            return response()->json(['status' => 'available']);
        }
        return response()->json(['status' => 'not_available']);
    }
}
