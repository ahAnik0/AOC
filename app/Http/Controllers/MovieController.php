<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MemberModel;
use App\Models\MovieModel;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{
    function movie_set_date($movie_id)
    {
        $movie = MovieModel::find($movie_id);
        return view('user.movie.select_date', compact('movie'));
    }

    function available_seat(Request $request)
    {
        $data = [
            'movie_id' => $request->movie_id,
            'date' => $request->date,
        ];
        
        $movies = MovieModel::where('start_date', '<=',$request->date)->where('end_date', '>=',$request->date)->get();
        return view('user.movie.available_seat',compact('data','movies'));
    }
    
    function dowmload_movie_ticket(\App\Http\Controllers\Admin\movie\MovieController $admin_Movie_controller,$id)
    {
        return $admin_Movie_controller->print_movie_ticket($id);
    }
}
