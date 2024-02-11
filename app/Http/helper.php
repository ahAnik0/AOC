<?php

use App\Models\DeviceModel;
use App\Models\MemberAssignDeviceModel;

function role_name()
{
    $role_name = \Illuminate\Support\Facades\Auth::user()->role->slag;
    return $role_name;
}

function user_id()
{
    $user_id = \Illuminate\Support\Facades\Auth::guard('user')->user()->id;
    return $user_id;
}

function admin_id()
{
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    return $user_id;
}

function member_id()
{
    $user_id = \Illuminate\Support\Facades\Auth::guard('user')->user()->member_id;
    return $user_id;
}

function member_name()
{
    $user_id = \Illuminate\Support\Facades\Auth::guard('user')->user()->fullname;
    return $user_id;
}

function course_member()
{
    return \Illuminate\Support\Facades\Auth::guard('user')->user();
}

function role_id()
{
    $user_id = \Illuminate\Support\Facades\Auth::user()->role->id;
    return $user_id;
}

function menu_check($value)
{
    $route = \Illuminate\Support\Facades\DB::table('dynamic_routes')->leftJoin('permission_roles', 'dynamic_routes.id', '=', 'permission_roles.dynamic_route_id')->select('dynamic_routes.*', 'permission_roles.url as permission_url');
    $total_access = $route->where('role_id', role_id())->where('show_in_menu', 1)->where('model_name', '=', $value)->get();
    return $total_access;
}

function get_parent_menu()
{
    $segment = request()->segment(3) ? request()->segment(2) . '/' . request()->segment(3) : request()->segment(2);
    $route = \App\dynamic_route::where('url', $segment)->first();
    return isset($route->menu->parent) ? $route->menu->parent->id : '';
}

function year()
{
    return range(1900, strftime("%Y", time()));
}

function seat_check($seat_number, $date)
{
    $available_seat = \App\Models\SeatBookedModel::where('seat_number', $seat_number)->where('date', $date)->count();
    return $available_seat == 0 ? '' : 'seat_disable';
}

function memberSearchWithBadgeNumber($badge_number)
{
    $member = \App\Models\MemberModel::where('badge_number', 'like', '%' . $badge_number . '%')->get();
    if ($member->count() > 0) {
        $member_name = $member->first()->fullname . '-' . $member->first()->member_id;
    } else {
        $member_name = '';
    }
    return $member_name;
}

function total_authh_count($badge_number, $start_date, $end_date)
{
    return \App\Models\AttLogModel::whereBetween('authDate', [$start_date, $end_date])->where('badge_number', $badge_number)->count();
}


function check_user_data_valid($user_id)
{
    $member = \App\Models\MemberModel::find($user_id);
    if (isset($member->connection_to)) {
        return true;
    } else {
        return false;
    }
}

function make_id_attlog_change($member_id)
{
    $member = \App\Models\MemberModel::find($member_id);
    $assign_member_device = MemberAssignDeviceModel::where('member_id', $member_id)->get();
    foreach ($assign_member_device as $data) {
        $data->status = 3;
        $data->update();
    }
    $total_device = DeviceModel::all();
    foreach ($total_device as $data) {
        $assign = new MemberAssignDeviceModel();
        $assign->member_id = $member->id;
        $assign->device_id = $data->id;
        $assign->card_id = $member->rfid;
        $assign->status = 1;
        $assign->save();
    }

//    function string_to_array($separetor, $data)
//    {
//        return explode($separetor, $data);
//    }
//
//    function string_replace($search_array, $data)
//    {
//        return str_replace(array($search_array), '', $data);
//    }
}





