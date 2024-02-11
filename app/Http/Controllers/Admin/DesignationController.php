<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\rank;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DesignationController extends Controller
{
    public function index()
    {
        return view('backend.designation.designation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);
        rank::create($request->all());
        return response()->json(['success' => 'Done']);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = rank::query();
            $query->orderBy('id', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-outline-danger btn-sm" onclick="delete_data(' . $data->id . ')">Delete</a> <a href="javascript:void(0)" class="edit btn btn-outline-success btn-sm" onclick="edit(' . $data->id . ')">Edit</a>';
                    return $actionBtn;
                })->rawColumns([ 'action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        rank::find($id)->delete();
        return response()->json(['success' => 'Done']);
    }

    public function edit($id)
    {
        $serving_unit = rank::find($id);
        return response()->json(['data' => $serving_unit]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);

        rank::find($request->edit_id)->update($request->all());
        return response()->json(['success' => 'Done']);
    }
}
