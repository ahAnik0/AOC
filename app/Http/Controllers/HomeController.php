<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }

    function print_id_card()
    {
         $member = MemberModel::find(3051);
        if ($member->parent_member_id) {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'NOK:' . $member->parent_member->fullname . ',' . 'P ADD:' . $member->address));
        } else {
            $qrcode = base64_encode(QrCode::format('svg')->generate($member->member_id_inputed . ', BA No:' . $member->ba_no . ',' . $member->fullname . ',' . 'CELL:' . $member->phone . ',' . 'P. ADD:' . $member->address));
        }

        $bar_code = DNS1D::getBarcodeHTML($member->ba_no, "C128", 1.5, 33);

        $pdf = PDF::loadView('backend.id_card_print.id_card_front', ["member" => $member, "qrcode" => $qrcode, 'barcode' => $bar_code]);
        $pdf->setPaper('A4', '');
        return $pdf->stream("",array("Attachment" => false));
    }
}
