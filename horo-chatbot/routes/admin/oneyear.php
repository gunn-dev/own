<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 2/5/20
 * Time: 10:17 AM
 */

Route::resource('oneyear', 'OneYearController');

Route::post('/oneyear/content/deliver/index','OneYearController@deliver')->name('oneyear.content.deliver.index');
Route::post('/oneyear/content/deliver','OneYearController@send')->name('oneyear.content.deliver');