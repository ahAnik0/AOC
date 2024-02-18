<?php

namespace App\Http\Controllers\Admin\movie;

use App\Http\Controllers\Controller;
use App\Models\BloodGroupModel;
use App\Models\MemberModel;
use App\Models\MovieBookingModel;
use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\rank;
use App\Models\SeatBookedModel;
use App\Models\ServingeUnitModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use PDF;

class MovieController extends Controller
{
    public function index()
    {
        return view('backend.Movie.index');
    }

    function create()
    {
        return view('backend.Movie.create_movie');
    }

    function bookingform()
    {
        $ranks = rank::all();
        $serving_units = ServingeUnitModel::all();
        $blood_groups = BloodGroupModel::all();
        return view('backend.Movie.booking.movie_booking', compact('ranks', 'blood_groups', 'serving_units'));
    }

    function booing_member_search(Request $request)
    {
        if ($request->ajax()) {
            $query = MemberModel::where('parent_member_id', null)->where('member_type', '!=', 4);

            if ($request->ba_no !== null) {
                $query->where('ba_no', 'like', '%' . $request->ba_no . '%');
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
                    return $data->designation->name;
                })->addColumn('exp_date', function ($data) {
                    return Carbon::parse($data->expire_date)->format('M d, Y');
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-success">Active</span>';
                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
//                    if ($data->movie){
//                        $movie_button = '<a class="btn btn-primary"  href="' . url('admin/movie/print_movie_ticket/' . $data->id) . '" ><i class="fa fa-tags"></i></a>';
//                    }else{
//                        $movie_button = '';
//                    }

                    $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-primary"  href="' . url('admin/movie/seat_confirm_form/' . $data->id . '/' . date('Y-m-d')) . '" ><i class="fa fa-tags"></i></a>
                   </div>
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['photo', 'designation', 'status', 'action'])
                ->make(true);
        }
    }

    function save_movie(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'show_time' => 'required',
//            'video_link' => 'required',
            'poster' => 'required',
//            'image' => 'required',
        ]);

        $poster = $request->file('poster');
        $image = $request->file('image');

        if ($poster) {
            $poster_Name = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move(public_path('uploads/movie'), $poster_Name);
        } else {
            $poster_Name = '';
        }


        if ($image) {
            $image_Name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/movie'), $image_Name);
        } else {
            $image_Name = '';
        }

        $member = new MovieModel();
        $member->title = $request->title;
        $member->start_date = $request->start_date;
        $member->end_date = $request->end_date;
        $member->show_time = $request->show_time;
        $member->video_link = $request->video_link;
        $member->poster = $poster_Name;
        $member->image = $image_Name;
        $member->desc = $request->desc;
        $member->save();

        Toastr::success('Save Successfully', 'Saved');
        return redirect()->route('admin.movie/index');
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $query = MovieModel::query();

            $query->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('poster', function ($data) {
                    $url = asset("uploads/movie/$data->poster");
                    return '<img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
                })->addColumn('start_date', function ($data) {
                    return Carbon::parse($data->start_date)->format('M d, Y');
                })->addColumn('end_date', function ($data) {
                    return Carbon::parse($data->end_date)->format('M d, Y');
                })->addColumn('action', function ($data) {
                    $actionBtn = '<div class="btn-group" role="group">
                           <a href="' . url('admin/movie/edit/' . $data->id) . '" class="btn btn-outline-success btn-xs" type="button">Edit</a> <a class="btn btn-outline-danger btn-xs " type="button" href="javascript:void(0)" onclick="delete_member(' . $data->id . ')">Delete</a></div> ';
                    return $actionBtn;
                })
                ->rawColumns(['poster', 'start_date', 'end_date', 'action'])
                ->make(true);
        }
    }

    function delete($id)
    {
        $movie = MovieModel::find($id)->delete();
        return response()->json(['success' => 'Done']);
    }

    function edit($id)
    {
        $movie = MovieModel::find($id);
        return view('backend.Movie.edit_movie', compact('movie'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'show_time' => 'required',
//            'video_link' => 'required',
        ]);

        $movie = MovieModel::find($id);

        $poster = $request->file('poster');
        $image = $request->file('image');

        if ($poster) {
            File::delete(public_path('uploads/movie/' . $movie->poster));
            $poster_Name = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move(public_path('uploads/movie'), $poster_Name);
        } else {
            $poster_Name = $movie->poster;
        }

        if ($image) {
            File::delete(public_path('uploads/movie/' . $movie->image));
            $image_Name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/movie'), $image_Name);
        } else {
            $image_Name = $movie->image;
        }

        $movie->title = $request->title;
        $movie->start_date = $request->start_date;
        $movie->end_date = $request->end_date;
        $movie->show_time = $request->show_time;
        $movie->video_link = $request->video_link;
        $movie->poster = $poster_Name;
        $movie->image = $image_Name;
        $movie->desc = $request->desc;
        $movie->update();

        Toastr::success('Updated Successfully', 'Saved');
        return redirect()->route('admin.movie/index');
    }

    function seat_confirm_form($id, $date)
    {
    //  $today = Carbon::now()->toDateString();
    //  $member = MemberModel::where('id',$id)->first();
        $movie = MovieModel::where('start_date', '<=', $date)->where('end_date', '>=', $date)->get();
        return view('backend.Movie.booking.seat_confirmation', compact('movie'));
    }

    function booking_submit(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required',
            'cb' => 'required',
        ]);

        $movie_booking = new MovieBookingModel();
        $movie_booking->member_id = $request->member_id;
        $movie_booking->movie_id = $request->movie_id;
        $movie_booking->amount = $request->amount;
        $movie_booking->date = $request->date;
        $movie_booking->remarks = $request->remarks;
        $movie_booking->save();

        foreach ($request->cb as $data) {
            $seat_booking = new SeatBookedModel();
            $seat_booking->bokking_id = $movie_booking->id;
            $seat_booking->date = $request->date;
            $seat_booking->seat_number = $data;
            $seat_booking->save();
        }

        $member = MemberModel::find($request->member_id);
        if ($member->parent_member_id == null) {
            $parent_member = $request->member_id;
        } else {
            $parent_member = $member->parent_member->id;
        }

        $movie_payment = new PaymentModel();
        $movie_payment->member_id = $parent_member;
        $movie_payment->type = 'movie_booking';
        $movie_payment->debit = 0;
        $movie_payment->credit = $request->amount;
        $movie_payment->ref_id = $movie_booking->id;
        $movie_payment->created_by = $request->member_id;
        $movie_payment->created_user_type = 'system';
        $movie_payment->save();

        Toastr::success('Updated Successfully', 'Saved');
        return redirect()->route('admin.report/movie_ticketing_report_index');
    }

    function print_movie_ticket($id)
    {
        $booking_details = MovieBookingModel::find($id);
        return view('backend.Movie.booking.movie_ticket', compact('booking_details'));
//        $pdf = PDF::loadView('backend.Movie.booking.movie_ticket', ["booking_details" => $booking_details]);
//        $pdf->setPaper('A4', 'landscape');
//        return $pdf->stream('sdsd' . "-" . str_pad(+1, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    function booking_for_guest_member()
    {
        return view('backend.Movie.booking.guest_member_booking');
    }

    function save_bokking_info_gust_user(Request $request)
    {
        request()->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'ba_no' => 'required',
//            'email' => 'required_if:image,=,null unique:members,email',
//            'address' => 'required',
        ]);

        $member = new MemberModel();
        $member->member_type = 4;
        $member->fullname = $request->fullname;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->ba_no = $request->ba_no;
        $member->password = Hash::make(12345678);
        $member->save();

        $date = date('Y-m-d');

        return redirect()->route('admin.movie/seat_confirm_form', [$member->id, date('Y-m-d')]);
    }

    function cencel_ticket(Request $request)
    {
        request()->validate([
            'cancel_id' => 'required',
            'cancel_reason' => 'required',
        ]);

        $booking = MovieBookingModel::find($request->cancel_id);
        $booking->remarks = $request->cancel_reason;
        $booking->amount = 0;
        $booking->update();

        SeatBookedModel::where('bokking_id', $request->cancel_id)->delete();
        PaymentModel::where('ref_id', $request->cancel_id)->delete();
        return response()->json(['success' => 'Done']);
    }


    function see_available_seat($date)
    {
        return view('backend.Movie.booking.see_available_seat');
    }
}
