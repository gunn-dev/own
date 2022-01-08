<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 9/17/20
 * Time: 10:08 AM
 */


Route::get('phonecall/service','PhoneCallServiceController@index')->name('phone_call.index');
Route::patch('/phone_call/service/edit/{id}', 'PhoneCallServiceController@edit');