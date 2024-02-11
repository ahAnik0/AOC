<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\HallBookingModel;
use App\Models\NoticeInfo;
use Illuminate\Http\Request;

class MainHomeController extends Controller
{

    public function index()
    {
        $notice = NoticeInfo::where('type', 0)->latest()->take(3)->get();
        $info = NoticeInfo::where('type', 1)->latest()->take(3)->get();

        return view('frontend.home.pages.home',compact('notice','info'));
    }

    function contact()
    {
        $contact = Contact::all();
        return view('frontend.home.pages.contact',compact('contact'));
    }

    function notice()
    {
        
        $notice = NoticeInfo::where('type', 0)->get();
        return view('frontend.home.pages.notice',compact('notice'));
    }

    function gallery()
    {
        return view('frontend.home.pages.gallery');
    }

    function information()
    {
        $info = NoticeInfo::where('type', 1)->get();

        return view('frontend.home.pages.information',compact('info'));
    }

    function hall_booking()
    {
        return view('frontend.home.pages.hall_booking');
    }
    
    function about_us()
    {
        return view('frontend.home.pages.about_us');
    }
    
    function privacy_policy()
    {
        return view('frontend.home.pages.privecy_policy');
    }
    
    function terms_condition()
    {
        return view('frontend.home.pages.terms_condition');
    }
    
    function refund_policy()
    {
        return view('frontend.home.pages.refund_policy');
    }

    function hall_booking_calender(Request $request)
    {
        if ($request->ajax()) {
            $data = HallBookingModel::whereDate('start', '>=', $request->start)
                ->join('members', 'hall_booking.member_id', '=', 'members.id')
                ->whereDate('end', '<=', $request->end)
                ->get(['hall_booking.id', 'title', 'start', 'end', 'details', 'amount', 'ba_no', 'phone', 'prog', 'color']);
            return response()->json($data);
        }
    }
}
