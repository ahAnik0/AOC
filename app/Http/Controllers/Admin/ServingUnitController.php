<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServingeUnitModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServingUnitController extends Controller
{
    public function index()
    {
        return view('backend.Serving_unit.serving_unit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        ServingeUnitModel::create($request->all());
        return response()->json(['success' => 'Done']);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = ServingeUnitModel::query();
            $query->orderBy('id', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = '<span class="right badge badge-success">Active</span>';
                    } elseif ($data->status == 0) {
                        $status = '<span class="right badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-outline-danger btn-sm" onclick="delete_data(' . $data->id . ')">Delete</a> <a href="javascript:void(0)" class="edit btn btn-outline-success btn-sm" onclick="edit(' . $data->id . ')">Edit</a>';
                    return $actionBtn;
                })->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        ServingeUnitModel::find($id)->delete();
        return response()->json(['success' => 'Done']);
    }

    public function edit($id)
    {
        $serving_unit = ServingeUnitModel::find($id);
        return response()->json(['data' => $serving_unit]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        ServingeUnitModel::find($request->edit_id)->update($request->all());

        return response()->json(['success' => 'Done']);
    }
}
