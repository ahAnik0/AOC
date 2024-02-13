<?php

use App\dynamic_route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MainHomeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\movie\MovieHomeController;
use App\Http\Controllers\user_auth\LoginController;
use App\Http\Controllers\member\SSlComarzController;
use App\Http\Controllers\Admin\HallBookingController;
use App\Http\Controllers\Admin\AdminDashboarController;

Route::middleware([])->group(function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('/clear_cache', function () {
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return 'Clear Cache';
    });

    Route::group(['prefix' => 'aoc_admin'], function () {
        Auth::routes(['register' => false]);
    });

    Route::get('/test', [TestController::class, 'index']);
    Route::get('/test2', [TestController::class, 'test2']);
    Route::get('/cancel', [TestController::class, 'cancel']);
    Route::get('/get_paid_and_unpaid_member', [TestController::class, 'get_paid_and_unpaid_member']);
    Route::get('/id_card_print', [HomeController::class, 'print_id_card']);
    Route::get('/relationship_search/{id}', [AjaxController::class, 'relationship_search']);

    Route::get('/', [MainHomeController::class, 'index'])->name('home');
    Route::get('/contact', [MainHomeController::class, 'contact'])->name('contact');
    Route::get('/about_us', [MainHomeController::class, 'about_us'])->name('about_us');
    Route::get('/privacy_policy', [MainHomeController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('/terms_condition', [MainHomeController::class, 'terms_condition'])->name('terms_condition');
    Route::get('/refund_policy', [MainHomeController::class, 'refund_policy'])->name('refund_policy');

    Route::get('/notice', [MainHomeController::class, 'notice'])->name('notice');
    Route::get('/gallery', [MainHomeController::class, 'gallery'])->name('gallery');
    Route::get('/information', [MainHomeController::class, 'information'])->name('information');
    Route::get('/hall_booking', [MainHomeController::class, 'hall_booking'])->name('hall_booking');
    Route::get('/hall_booking_calender', [MainHomeController::class, 'hall_booking_calender'])->name('hall_booking_calender');
    Route::get('/movie', [MovieHomeController::class, 'index'])->name('movie');

    //movie home controller

    Route::get('/movie_list', [MovieHomeController::class, 'movie_list'])->name('movie_list');
    Route::get('/movie_single/{id}', [MovieHomeController::class, 'movie_single'])->name('movie_single');
    Route::get('/movie_booking/{id}', [MovieHomeController::class, 'movie_booking'])->name('movie_booking');
    Route::get('/seat_booking/{id}', [MovieHomeController::class, 'seat_booking'])->name('seat_booking');

    Route::post('/admin_logout', [AdminDashboarController::class, 'admin_logout'])->name('admin_logout');
    Route::post('/ceo_image_upload', [AdminDashboarController::class, 'ceo_image_upload'])->name('ceo_image_upload');

    Route::middleware(['auth', 'routeprifix'])->prefix('{roleBased}')->group(function () {
        Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
            foreach (dynamic_route::where('route_status', 1)->get() as $value) {
                if ($value->method == 'get') {
                    Route::get($value->url . '/' . $value->parameter, $value->controller_action . '@' . $value->function_name)->name($value->url);
                } else {
                    Route::Post($value->url . '/' . $value->parameter, $value->controller_action . '@' . $value->function_name)->name($value->url);
                }
            }
        });
        Route::get('/generate-pdf', [ServiceController::class, 'generatePDF'])->name('pdf-show');
        // Route::get('/admin.member/payment_receipt_print/{id}', [MemberController::class, 'payment_receipt_print'])->name('admin.member/payment_receipt_print');

    });
    Route::get('/check_date', [HallBookingController::class, 'check_date'])->name('check_date');
    Route::get('/edit_check_date', [HallBookingController::class, 'edit_check_date'])->name('edit_check_date');


    //all user route
    Route::get('/user/login', [LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/user/login', [LoginController::class, 'login'])->name('user.login');
    Route::post('/user/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::group(['middleware' => ['user'], 'prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
        //basic profile info
        Route::get('userdashboard', [UserController::class, 'userdashboard'])->name('userdashboard');
        Route::get('change_password', [UserController::class, 'change_password'])->name('change_password');
        Route::post('update_change_password', [UserController::class, 'update_change_password'])->name('update_change_password');
        //other section
        Route::get('user_profile', [UserController::class, 'user_profile'])->name('user_profile');
        Route::get('pay_bill', [UserController::class, 'pay_bill'])->name('pay_bill');

        //movie_booking
        Route::get('movie_set_date/{movie_id}', [MovieController::class, 'movie_set_date'])->name('movie_set_date');
        Route::get('available_seat', [MovieController::class, 'available_seat'])->name('available_seat');
        Route::get('dowmload_movie_ticket/{id}', [MovieController::class, 'dowmload_movie_ticket'])->name('dowmload_movie_ticket');


        //ssl payment
        Route::post('payViaAjax', [SSlComarzController::class, 'payViaAjax'])->name('payViaAjax');
    });
});

Route::post('member/sslcommerz/success', [SSlComarzController::class, 'success'])->name('success');
Route::post('member/sslcommerz/fail', [SSlComarzController::class, 'fail'])->name('failure');
Route::post('member/sslcommerz/cancel', [SSlComarzController::class, 'cancel'])->name('cancel');
Route::post('member/sslcommerz/ipn', [SSlComarzController::class, 'ipn'])->name('ipn');


Route::post('tappayment', [TapController::class, 'tappayment'])->name('tappayment');
Route::post('movie_payment', [TapController::class, 'movie_payment'])->name('movie_payment');

Route::get('/device_list', [\App\Http\Controllers\API\AttendenceController::class, 'device_list']);
Route::post('/upload_log', [\App\Http\Controllers\API\AttendenceController::class, 'upload_log']);
Route::post('/uploadEmpList', [\App\Http\Controllers\API\AttendenceController::class, 'uploadEmpList']);
Route::post('/syncid', [\App\Http\Controllers\API\AttendenceController::class, 'syncid']);
Route::post('/UpdateStatus', [\App\Http\Controllers\API\AttendenceController::class, 'UpdateStatus']);
