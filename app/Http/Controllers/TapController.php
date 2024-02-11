<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MemberModel;
use App\Models\MovieBookingModel;
use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\SeatBookedModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TapController extends Controller
{
    function tappayment(Request $request)
    {
        if ($request->status == "completed") {
            $additional_data = $request['additionalInfos'][1]['value'];
            $array_data = explode('|', $additional_data);
            $number_of_month = str_replace(array('{', '}'), '', $array_data[0]);

            if (!PaymentModel::select('transactionId')->where('transactionId', $request->transactionId)->first()) {
                $this->update_card_data($request->requestorReferenceId, $number_of_month, 'renew', $request->amount, $request->transactionId);

                make_id_attlog_change($request->requestorReferenceId);
            }
            Storage::put('file.txt', $request);
            return response()->json(['data' => 'success']);
        } else {
            return response()->json(['error' => 'Transaction incomplete']);
        }
    }


    protected function update_card_data($member_id, $number_of_month, $payment_type, $amount, $transactionId)
    {
        $member = MemberModel::find($member_id);
        $now = date('Y-m-d H:i:s');
        $debit = 0;
        $credit = $amount;

        // credit add into into payment table
        $payment_values = array(
            'member_id' => $member_id,
            'type' => $payment_type,
            'comment' => 'By TAP',
            'debit' => $debit,
            'credit' => $credit,
            'created_at' => $now,
            'created_by' => $member_id,
            'transactionId' => $transactionId,
            'created_user_type' => 'member',
        );
        DB::table('payments')->insert($payment_values);
        $connection_to = Carbon::createFromFormat('Y-m-d', $member->connection_to)->addMonth($number_of_month);
        $connection_from = Carbon::now();

        //update member data
        $update_member_data = [
            'connection_from' => $connection_from,
            'connection_to' => $connection_to,
            'status' => 1,
        ];
        DB::table('members')->where('id', $member_id)->update($update_member_data);
    }

// movie payment
    function movie_payment(Request $request)
    {


        if ($request->status == "completed") {

            $additional_data = $request['additionalInfos'][1]['value'];
            $array_data = explode('|', $additional_data);
            $seats_string = str_replace(array('{', '}'), '', $array_data[0]);
            $seat_array = explode(',', $seats_string);
            $boking_date = str_replace(array('{', '}'), '', $array_data[1]);
            $movie_id = str_replace(array('{', '}'), '', $array_data[2]);

            $member_id = $request->requestorReferenceId;
            $amount = $request->amount;


            if (!PaymentModel::select('transactionId')->where('transactionId', $request->transactionId)->first()) {

                $this->movie_tocket_booking($member_id, $movie_id, $seat_array, $boking_date, $amount);
            }
            return response()->json(['data' => 'success']);
        } else {
            return response()->json(['error' => 'Transaction incomplete']);
        }
    }

    function movie_tocket_booking($member_id, $movie_id, $seats, $booking_date, $amount)
    {
        $movie_booking = new MovieBookingModel();
        $movie_booking->member_id = $member_id;
        $movie_booking->movie_id = $movie_id;
        $movie_booking->amount = $amount;
        $movie_booking->date = $booking_date;
        $movie_booking->save();

        foreach ($seats as $data) {
            $seat_booking = new SeatBookedModel();
            $seat_booking->bokking_id = $movie_booking->id;
            $seat_booking->date = $booking_date;
            $seat_booking->seat_number = $data;
            $seat_booking->save();
        }

        $member = MemberModel::find($member_id);
        if ($member->parent_member_id == null) {
            $parent_member = $member_id;
        } else {
            $parent_member = $member->parent_member->id;
        }

        $movie_payment = new PaymentModel();
        $movie_payment->member_id = $parent_member;
        $movie_payment->type = 'movie_booking';
        $movie_payment->debit = 0;
        $movie_payment->credit = $amount;
        $movie_payment->ref_id = $movie_booking->id;
        $movie_payment->created_by = $member_id;
        $movie_payment->created_user_type = 'member';
        $movie_payment->save();
    }
}
