<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Admin;
use PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Models\MemberModel;
use App\Models\PaymentModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MovieBookingModel;
use Illuminate\Support\Facades\DB;
use App\Models\LibraryBookingModel;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminDashboarController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $total_member = MemberModel::all()->count();
        $active_member = MemberModel::where('status', 1)->count();
        $inactive_member = MemberModel::where('status', 0)->count();
        $movie_ticket_sell = MovieBookingModel::all()->sum('amount');
        $total_book_rent = LibraryBookingModel::count();
        $total_payment = PaymentModel::sum('credit');
        $total_payment_today = PaymentModel::whereBetween('created_at', [$today, $tomorrow])->sum('credit');
        $total_service_sell = PaymentModel::whereIn('type', ['swimming', 'bowling', 'gym', 'steam_bath', 'sauna_bath'])->sum('credit');
        return view('backend.dashboard.dashboard', compact('total_member', 'active_member', 'inactive_member', 'movie_ticket_sell', 'total_service_sell', 'total_book_rent', 'total_payment', 'total_payment_today'));
    }


    public function save_change_password(Request $request)
    {
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

        $current_password = Auth::User()->password;
        if (Hash::check($request->input('current_password'), $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = Admin::find($user_id);
            $obj_user->password = Hash::make($request->input('password'));
            $obj_user->update();
            Toastr::success('Password Save Successfully', 'Changed');
            return redirect()->route('admin.adminDashboard');
        } else {
            Toastr::error('Please enter correct current password', 'Wrong');
            return redirect()->back();
        }
    }

    public function change_pasword()
    {
        return view('backend.partial.change_password');
    }


    public function admin_logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    function payment_history_report($type)
    {
        if ($type == "payment") {
            //        payment history last 30 days
            $day_by_day_payment_history = DB::table('payments')->select('id_payment_key', 'credit', 'type', 'created_at')->whereIn('type', ['renew', 'movie_booking', 'monthly_payment', 'swimming', 'bowling', 'gym', 'steam_bath', 'sauna_bath', 'salon'])
                ->whereDate('payments.created_at', '>', Carbon::now()->subDays(30))->get()->groupBy
                (function ($grouped) {
                    return (new Carbon($grouped->created_at))->format('d/m/y');
                });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('credit');
            }
        } elseif ($type = "movie_chart") {
            $day_by_day_payment_history = DB::table('payments')->select('id_payment_key', 'credit', 'type', 'created_at')->whereIn('type', ['movie_booking'])
                ->whereDate('payments.created_at', '>', Carbon::now()->subDays(30))->get()->groupBy
                (function ($grouped) {
                    return (new Carbon($grouped->created_at))->format('d/m/y');
                });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('credit');
            }
        } elseif ($type = "service") {
            $day_by_day_payment_history = DB::table('payments')->select('id_payment_key', 'credit', 'type', 'created_at')->whereIn('type', ['swimming', 'bowling', 'gym', 'steam_bath', 'sauna_bath'])
                ->whereDate('payments.created_at', '>', Carbon::now()->subDays(30))->get()->groupBy
                (function ($grouped) {
                    return (new Carbon($grouped->created_at))->format('d/m/y');
                });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('credit');
            }
        } elseif ($type = "bowling") {
            $day_by_day_payment_history = DB::table('payments')->select('id_payment_key', 'credit', 'type', 'created_at')->whereIn('type', ['bowling'])
                ->whereDate('payments.created_at', '>', Carbon::now()->subDays(30))->get()->groupBy
                (function ($grouped) {
                    return (new Carbon($grouped->created_at))->format('d/m/y');
                });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('credit');
            }
        } elseif ($type = "salon_chart") {
            $day_by_day_payment_history = DB::table('payments')->select('id_payment_key', 'credit', 'type', 'created_at')->whereIn('type', ['salon'])
                ->whereDate('payments.created_at', '>', Carbon::now()->subDays(30))->get()->groupBy
                (function ($grouped) {
                    return (new Carbon($grouped->created_at))->format('d/m/y');
                });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('credit');
            }
        }
        return Response::json(['lebel' => $lebel, 'data' => $data], 200);
    }


    function ceo_image_upload(Request $request)
    {
        $rules = array(
            'ceo_image' => 'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $name = time() . '.' . request()->ceo_image->getClientOriginalExtension();
        $setting = SettingModel::where('name', 'ceo_image')->first();
        $setting->image = $name;
        $setting->update();

        $request->ceo_image->move(public_path('uploads/setting'), $name);

        return redirect()->back();
    }
   
}
