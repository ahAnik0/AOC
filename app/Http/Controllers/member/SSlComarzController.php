<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\MemberModel;
use App\package;
use App\subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \RouterOS\Query;

class SSlComarzController extends Controller
{
    public function payViaAjax(Request $request)
    {
        $subscriber = MemberModel::find($request->member_id);
        $data = json_decode($request->cart_json, true);
        $post_data = array();
        $post_data['total_amount'] = $request->amount;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid();

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $subscriber->fullname;
        $post_data['cus_email'] = $subscriber->email?$subscriber->email:'aoc@gmail.com';
        $post_data['cus_add1'] = $subscriber->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $subscriber->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $request->number_of_month; //number of munth
        $post_data['value_b'] = $request->member_id; //member id
        $post_data['value_c'] = "monthly_payment"; // payment type

        $values = array(
            'member_id' => $request->member_id,
            'name' => $post_data['cus_name'],
            'email' => $post_data['cus_email'],
            'amount' => $post_data['total_amount'],
            'phone' => $post_data['cus_phone'],
            'status' => 0,
            'address' => $post_data['cus_add1'],
            'transaction_id' => $post_data['tran_id'],
            'payment_by' => 'renew',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        );
        DB::table('ssl_payments')->insert($values);
        $sslc = new SslCommerzNotification();

        $payment_options = $sslc->makePayment($post_data, 'hosted');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $order_detials = DB::table('ssl_payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 0) {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                DB::table('ssl_payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 1]);
                $this->update_card_data($request->value_b, $request->value_a, $request->value_c, $amount);
                Toastr::success('Transaction is successfully Completed', 'Completed');
                return redirect()->route('user.pay_bill');
            } else {
                DB::table('ssl_payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 3]);
                Toastr::error('validation Fail', 'failed');
                return redirect()->route('user.pay_bill');
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 1]);
            $this->update_card_data($request->value_b, $request->value_a, $request->value_c, $amount);
            Toastr::success('Transaction is successfully Completed', 'Completed');
            return redirect()->route('user.pay_bill');
        } else {
            DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 3]);
            Toastr::error('Invalid Transaction', 'Invalid');
            return redirect()->route('user.pay_bill');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('ssl_payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();
        if ($order_detials->status == 0) {
            $update_product = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 3]);
            Toastr::error('Transaction is Falied', 'Falied');
            return redirect()->route('user.pay_bill');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful', 'Successful');
            return redirect()->route('user.pay_bill');
        } else {
            Toastr::error('Invalid Transaction', 'Invalid');
            return redirect()->route('user.pay_bill');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('ssl_payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 0) {
            $update_product = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 2]);
            Toastr::error('Transaction is Cancel', 'Cancel');
            return redirect()->route('user.pay_bill');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful', 'Successful');
            return redirect()->route('user.payment_page');
        } else {
            Toastr::error('Invalid Transaction', 'Invalid');
            return redirect()->route('user.pay_bill');
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('ssl_payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 0) {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $this->Establish_connection($request->value_b, $request->value_a, $request->value_c, $order_details->amount);
                    $update_product = DB::table('ssl_payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 1]);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('ssl_payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 3]);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    protected function update_card_data($member_id, $number_of_month, $payment_type, $amount)
    {
        $member = MemberModel::find($member_id);
        $now = date('Y-m-d H:i:s');
        $debit = 0;
        $credit = $amount;

        // credit add into into payment table
        $payment_values = array(
            'member_id' => $member_id,
            'type' => $payment_type,
            'comment' => 'By online',
            'debit' => $debit,
            'credit' => $credit,
            'created_at' => $now,
            'created_by' => $member_id,
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

}
