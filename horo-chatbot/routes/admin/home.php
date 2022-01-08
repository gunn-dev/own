<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 12/11/19
 * Time: 2:41 PM
 */

Route::get('home', 'AdminHomeController@index')->name('home');

Route::post('search','AdminHomeController@search')->name('search');


Route::post('getUser','AdminHomeController@getUSer')->name('getProfile');

