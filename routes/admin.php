<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.post.login');
Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', 'Admin\AdminController@index');

    Route::resource('aboutus', 'Admin\AboutController');
    Route::put('aboutus/status/{id}', 'Admin\AboutController@status')->name('statusAboutus');

    Route::resource('course', 'Admin\CourseController');
    Route::put('course/status/{id}', 'Admin\CourseController@status')->name('statusCourse');
    Route::get('/deleteImage/{id}', 'Admin\CourseController@deleteImage')->name('deleteImageCourse');

    Route::resource('album', 'Admin\AlbumController');
    Route::put('album/status/{id}', 'Admin\AlbumController@status')->name('statusAlbum');

    Route::resource('place', 'Admin\PlacesController');
    Route::put('place/status/{id}', 'Admin\PlacesController@status')->name('statusPlace');

    Route::resource('trip', 'Admin\TripController');
    Route::put('trip/status/{id}', 'Admin\TripController@status')->name('statusTrip');
    Route::get('/deleteImage/{id}', 'Admin\TripController@deleteImage')->name('deleteImageTrip');

    Route::resource('activity', 'Admin\ActivityController');
    Route::put('activity/status/{id}', 'Admin\ActivityController@status')->name('statusActivity');

    Route::resource('level', 'Admin\LevelController');
    Route::put('level/status/{id}', 'Admin\LevelController@status')->name('statusLevel');

    Route::resource('setting', 'Admin\SettingController');
    Route::get('/setting/{setting}', 'Admin\SettingController@edit')->name('setting.edit');
    Route::post('/setting/{setting}', 'Admin\SettingController@update')->name('setting.update');

    Route::resource('booking', 'Admin\BookingController');
});