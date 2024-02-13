<?php

namespace App\Http\Controllers\user_auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('user_auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'member_id' => 'required',
            'password' => 'required|min:3'
        ]);

        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['member_id_inputed' => $request->member_id, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if (Session::get('movie')) {
                return redirect()->intended(route('user.movie_set_date', Session::get('movie')));
            } else {
                return redirect()->intended(route('user.userdashboard'));
            }
        }
        // if unsuccessful, then redirect back to the login with the form data
        Toastr::error('This Credential does not match', '');
        return redirect()->back()->withInput($request->only('member_id', 'remember'));
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/user/login');
    }
}
