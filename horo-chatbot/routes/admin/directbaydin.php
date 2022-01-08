<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 4/21/20
 * Time: 1:17 PM
 */

Route::resource('directbaydin', 'DirectBaydinController');

Route::post('/directbaydin/content/deliver/index','DirectBaydinController@deliver')->name('directbaydin.content.deliver.index');
Route::post('/directbaydin/content/deliver','DirectBaydinController@send')->name('directbaydin.content.deliver');