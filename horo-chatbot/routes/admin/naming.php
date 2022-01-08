<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 1/14/20
 * Time: 2:54 PM
 */

Route::resource('child', 'ChildNamingController');

Route::resource('business', 'BusinessNamingController');


Route::post('/child/content/deliver/index','ChildNamingController@deliver')->name('child.content.deliver.index');

Route::post('/business/content/deliver/index','BusinessNamingController@deliver')->name('business.content.deliver.index');

Route::post('/child/content/deliver','ChildNamingController@send')->name('child.content.deliver');

Route::post('/business/content/deliver','BusinessNamingController@send')->name('business.content.deliver');