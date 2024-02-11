<?php

namespace App\Http\Controllers;

use App\Models\RelationshipModel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function relationship_search($id)
    {
        $relationship = RelationshipModel::find($id)->abbrivation;

        return response()->json([$relationship]);
    }
}
