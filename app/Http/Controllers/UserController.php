<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ServiceJobController;
use App\Models\ChildrenDetailsModel;
use App\Models\EducationModel;
use App\Models\InternationalApplicantBasicInfoModel;
use App\Models\LibraryBookingModel;
use App\Models\MemberModel;
use App\Models\MovieBookingModel;
use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\PersonalProfileModel;
use App\Models\service;
use App\Models\ServiceModel;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\MaritalStatusModel;
use App\Models\OtherFileModel;
use App\Models\PassportDetailsModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function userdashboard()
    {
        $payment_history = PaymentModel::where('member_id',user_id())->orderBy('id_payment_key', 'DESC')->get();
        $service_history = service::where('member_id',user_id())->orderBy('id', 'DESC')->get();
        $library_booking = LibraryBookingModel::where('member_id',user_id())->orderBy('id', 'DESC')->get();
        $movie_booking = MovieBookingModel::where('member_id',user_id())->orderBy('id', 'DESC')->get();
        return view('user.dashboard.UserDashbaord',compact('payment_history','service_history','library_booking','movie_booking'));
    }

    public function change_password()
    {
        return view('user.partial.change_password');
    }

    function user_profile()
    {
        $member = MemberModel::find(user_id());
        $relation = MemberModel::where('parent_member_id', user_id())->get();
        return view('user.pages.user_profile', compact('member', 'relation'));
    }

    function pay_bill()
    {
        $member = MemberModel::find(user_id());

        if ($member->connection_to < Carbon::now()) {
            $number_of_due_month = Carbon::createFromDate($member->connection_to)->diffInMonths(Carbon::now());
        } else {
            $number_of_due_month = null;
        }
        return view('user.pages.pay_monthly', compact('member', 'number_of_due_month'));
    }

    public function update_change_password(Request $request)
    {
        if ($request->current_password == null) {
            $validatedData = $request->validate([
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|same:password',
            ], [
                'password.required' => 'Password is required',
                'password.min' => 'Password needs to have at least 8 characters',
                'password_confirmation.required' => 'Passwords do not match'
            ]);

            $user = User::find(user_id());
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
                $user->update();
                Toastr::success('Password Save Successfully', 'Changed');
                return redirect()->back();
            } else {
                Toastr::error('Please enter correct current password', 'Wrong');
                return redirect()->back();
            }
        } else {
            $validatedData = $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|same:password',
            ], [
                'current_password.required' => 'Old password is required',
                'current_password.min' => 'Old password needs to have at least 8 characters',
                'password.required' => 'Password is required',
                'password.min' => 'Password needs to have at least 8 characters',
                'password_confirmation.required' => 'Passwords do not match'
            ]);

            $user = User::find(user_id());
            $current_password = $user->password;
            if (Hash::check($request->input('current_password'), $current_password)) {
                $user->password = Hash::make($request->input('password'));
                $user->update();
                Toastr::success('Password Save Successfully', 'Changed');
                return redirect()->back();
            } else {
                Toastr::error('Please enter correct current password', 'Wrong');
                return redirect()->back();
            }
        }
    }
}
