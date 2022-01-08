<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('call_service.index')->with([
        'lang' => 'uni',
        'user_id' => '545454'
    ]);
});

Route::get('/oneyear', function () {
    return view('oneyear.index')->with([
        'lang' => 'uni',
        'user_id' => '545454'
    ]);
});


Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Route::get('/botman/tinker', 'BotManController@tinker');

Route::get('/horo/subscription', 'PaymentController@index');

Route::get('/horo/manual/payment', 'PaymentController@manual');

Route::post('/horo/payment', 'PaymentController@payment')->name('payment');

Route::post('/horo/payment/notification', 'PaymentController@notifyPayment');

Route::get('/horo/naming/business', 'NamingController@business_index');

Route::get('/horo/naming/child', 'NamingController@child_index');

Route::get('/horo/one/year', 'OneYearController@index');

Route::post('/horo/one/year/create', 'OneYearController@store')->name('oneyear.store');

Route::post('/horo/child/naming/create', 'NamingController@child')->name('child');

Route::post('/horo/business/naming/create', 'NamingController@business')->name('business');

Route::any('horo/payment/redirect', 'PaymentController@paymentRedirect');

Route::get('horo/naming/get/content', 'GetContentFileController@getContentFile');

Route::resource('lovebaydin', 'LoveBayDinController');

Route::get('direct/horo', 'DirectBaydinController@index');

Route::post('direct/baydin', 'DirectBaydinController@store')->name('directbaydin.store');

Route::get('baydin_sayar/horo', 'BaydinSayarCallController@index');

Route::post('baydin_sayar/baydin', 'BaydinSayarCallController@store')->name('baydinsayar_call.store');




Route::group([
    'middleware' => 'auth',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {

    includeRouteFiles(__DIR__ . '/admin');
});

Route::group([
    'namespace' => 'Frontend'
], function () {
    Route::match(['get', 'post'], '/star_phone/{type}/horoscope', 'StarPhonePaymentController@index');
    Route::post('/horoscope/star_phone/payment/notification', 'StarPhonePaymentController@notifyPayment');
    Route::post('/horoscope/star_phone/payment/create', 'StarPhonePaymentController@paymentCreate')->name('payment.create');
    Route::patch('/star_phone/payment/edit/{id}', 'StarPhonePaymentController@edit');
    Route::get('/star_phone/horoscope/payment', 'StarPhonePaymentController@payment_index')->name('starphone.payment');
});

//Auth::routes();

Route::get('admin/login', 'AuthController@index')->name('login.index');
Route::post('admin/post-login', 'AuthController@postLogin')->name('admin.login');
Route::get('admin/logout', 'AuthController@logout')->name('admin.logout');
Route::get('/home', 'HomeController@index')->name('home');


Route::get('astrology/privacy-policy', function () {
    return view('privacy');
});
