<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetails;
use App\Models\BookModel;
use App\Models\LibraryBookingModel;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class LibraryController extends Controller
{
    public function index()
    {
        return view('backend.library.books');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required',
            'book_author' => 'required',
            'price' => 'required',
            'buy_price' => 'required',
            'quantity' => 'required',
        ]);

        BookModel::create($request->all());
        return response()->json(['success' => 'Done']);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = BookModel::query();
            $query->orderBy('created_at', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-danger">Not Available</span>';

                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-success">Available</span>';
                    }
                    return $status;
                })->addColumn('total_price', function ($data) {
                    return $data->quantity * $data->price;
                })->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-outline-danger btn-sm" onclick="delete_data(' . $data->id . ')">Delete</a> <a href="javascript:void(0)" class="edit btn btn-outline-success btn-sm" onclick="edit(' . $data->id . ')">Edit</a>';
                    return $actionBtn;
                })->with('total_qty', $query->sum('quantity'))
                ->with('total_price', $query->sum('price'))
                ->with('buy_price', $query->sum('buy_price'))
                ->with('actual_price', $query->sum(DB::raw('price * quantity')))
                ->rawColumns(['status', 'action', 'total_price'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        BookModel::find($id)->delete();
        return response()->json(['success' => 'Done']);
    }

    public function edit($id)
    {
        $serving_unit = BookModel::find($id);
        return response()->json(['data' => $serving_unit]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_name' => 'required',
            'book_author' => 'required',
            'price' => 'required',
        ]);

        BookModel::find($request->edit_id)->update($request->all());

        return response()->json(['success' => 'Done']);
    }

    function library_booking_form()
    {
        $books = BookModel::where('quantity', '>', 0)->get();
        return view('backend.library.library_booking.library_booking', compact('books'));
    }

    function submit_booking(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'grand_total' => 'required',
            'quantity' => 'required',
            'stock_id' => 'required',
            'per_quantity' => 'required',
            'per_total_unit_price' => 'required',
        ]);

        for ($i = 0; $i < count($request->stock_id); $i++) {
            $quantity = BookModel::find($request->stock_id[$i])->quantity;
            if ($request->per_quantity[$i] > $quantity) {
                return response()->json(['error' => 'Quantity of an item is grater than stock quantity']);
            }
        }

        $booking = new LibraryBookingModel();
        $booking->member_id = $request->member_id;
        $booking->quantity = $request->quantity;
        $booking->amount = $request->grand_total;
        $booking->save();


        for ($i = 0; $i < count($request->stock_id); $i++) {
            $stock = BookModel::find($request->stock_id[$i]);
            $stock->quantity -= $request->per_quantity[$i];
            $stock->status = 1;
            $stock->update();
        }

        for ($i = 0; $i < count($request->stock_id); $i++) {
            $stock_book = BookModel::find($request->stock_id[$i]);
            $booking_details = new BookingDetails();
            $booking_details->booking_id = $booking->id;
            $booking_details->book_id = $request->stock_id[$i];
            $booking_details->qty = $request->per_quantity[$i];
            $booking_details->amount = $request->per_total_unit_price[$i];
            $booking_details->buying_price = $stock_book->buy_price * $request->per_quantity[$i];
            $booking_details->total_profit = $request->per_total_unit_price[$i] - ($stock_book->buy_price * $request->per_quantity[$i]);
            $booking_details->save();
        }

        $payment = new PaymentModel();
        $payment->member_id = $request->member_id;
        $payment->type = 'library_booking';
        $payment->debit = 0;
        $payment->credit = $request->grand_total;
        $payment->ref_id = $booking->id;
        $payment->created_by = $request->member_id;
        $payment->created_user_type = 'system';
        $payment->save();

        return response()->json(['success' => 'success', 'booking_id' => $booking->id]);
    }

    function all_library_booking_index()
    {
        return view('backend.library.library_booking.all_library_booking');
    }

    function library_booking_search(Request $request)
    {
        if ($request->ajax()) {
            $query = LibraryBookingModel::query();

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
                    $query2->where('member_id_inputed', 'like', '%' . $request->member_id . '%');
                });
            }

            if ($request->booking_details !== null) {
                $query->whereHas('book', function ($query2) use ($request) {
                    $query2->where('book_name', 'like', '%' . $request->book_name . '%');
                });
            }

            $query->orderBy('created_at', 'desc');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('member', function ($data) {
                    return $data->member->fullname;
                })->addColumn('book', function ($data) {
                    $books = [];
                    foreach ($data->booking_details as $data) {
                        $books[] = $data->book_details->book_name;
                    }
                    return implode(",", $books);
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-danger">Booked</span>';

                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-success">Returned</span>';
                    }
                    return $status;
                })->addColumn('profit', function ($data) {
                    return BookingDetails::where('booking_id', $data->id)->sum('total_profit');
                })->addColumn('action', function ($data) {
                    $actionBtn = '';
                    if ($data->remarks == null) {
                        $actionBtn = '<a class="btn btn-outline-danger btn-xs " type="button" href="' . url('admin/library/library_slip_print/' . $data->id) . '" target="_blank">Print receipt</a> <a class="btn btn-danger btn-xs"  href="#" onclick="cancel(' . $data->id . ')">Cancel</a></div> ';
                    } else {
                        $actionBtn = '<div class="btn-group" role="group">
<a class="btn btn-success btn-xs disabled"  >Cancel</a></div>';
                    }
                    return $actionBtn;
                })->with('sum', $query->sum('amount'))
//                ->with('total_profit', $query->sum('total_profit'))
                ->rawColumns(['member', 'book', 'status', 'action', 'profit'])
                ->make(true);
        }
    }

    function change_booking_status($id)
    {
        $library = LibraryBookingModel::find($id);
        $library->status = 0;
        $library->update();

        $book = BookModel::find($library->book_id);
//        $book->status = 1;
        $book->quantity += 1;
        $book->update();

        return response()->json(['success' => 'Done']);
    }

    function search_book(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = BookModel::where('quantity', '>', 0)
                ->Where('book_name', 'like', '%' . $query . '%')
                ->get();

            $output = '<ul class="list-group l-class" style="display: block;position: relative;width: 100%;font-size: 17px;font-weight: bold;line-height: 25px;border: 1px solid;cursor: pointer;">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item bg-success book_list" onclick=getBookData(' . $row->id . ')>' . $row->book_name . '(author:' . $row->book_author . ')</li>';

            }
            $output .= '</ul>';
            echo $output;
        }
    }


    function single_book_search($id)
    {
        $book = BookModel::query()->select('id', 'price', 'quantity', 'book_name')
            ->where('quantity', '>', 0)
            ->where('id', $id)
            ->first();

        return response()->json(['book' => $book]);
    }


    function library_slip_print($id)
    {
        $service = LibraryBookingModel::find($id);
        return view('backend.library.library_booking.library_receipt_print', compact('service'));
//        $pdf = PDF::loadView('backend.library.library_booking.library_receipt_print', ["service" => $service]);
//        $pdf->setPaper('A4', '');
//        return $pdf->stream('file.pdf', array('Attachment' => 0));
    }

    function cancel_booking(Request $request)
    {
        request()->validate([
            'cancel_id' => 'required',
            'cancel_reason' => 'required',
        ]);

        $booking = LibraryBookingModel::find($request->cancel_id);
        $booking->remarks = $request->cancel_reason;
        $booking->amount = 0;
        $booking->update();

        BookingDetails::where('booking_id', $request->cancel_id)->delete();
        PaymentModel::where('ref_id', $request->cancel_id)->delete();
        return response()->json(['success' => 'Done']);
    }


}
