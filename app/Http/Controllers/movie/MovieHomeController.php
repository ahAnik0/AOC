<?php

namespace App\Http\Controllers\movie;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\MemberModel;
use App\Models\MovieModel;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MovieHomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $movie = MovieModel::where('end_date', '>=', $today)->get();
        return view('frontend.home.pages.movie', compact('movie'));
    }

    function movie_single($id)
    {
        return view('frontend.pages.movie.movie_single');
    }

    function movie_list()
    {
        return view('frontend.pages.movie.movie_list');
    }

    function movie_booking($id)
    {
        return view('frontend.pages.movie.movie_booking');
    }

    function seat_booking($id)
    {
        return view('frontend.pages.movie.seat_booking');
    }
}
