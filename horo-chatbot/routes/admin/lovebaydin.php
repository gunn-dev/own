<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 4/21/20
 * Time: 1:17 PM
 */

Route::resource('lovebaydin', 'LoveBayDinController');

Route::post('/lovebaydin/content/deliver/index','LoveBayDinController@deliver')->name('lovebaydin.content.deliver.index');
Route::post('/lovebaydin/content/deliver','LoveBayDinController@send')->name('lovebaydin.content.deliver');