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

/* Route::get('/', function () {
    return view('base.baseUser');
}); */

Auth::routes();

Route::get('/','Front\HomeController@home')->name('home.page');

Route::get('/about','Front\HomeController@about')->name('about.front.index');
Route::get('/about/{about}','Front\HomeController@aboutShow')->name('about.front.show');

Route::get('/activity','Front\HomeController@activity')->name('activity.front.index');
Route::get('/activity/{activity}','Front\HomeController@activityShow')->name('activity.front.show');

Route::get('/place','Front\HomeController@place')->name('place.front.index');
Route::get('/place/{place}','Front\HomeController@placeShow')->name('place.front.show');

Route::get('/courses','Front\HomeController@course')->name('course.front.index');
Route::get('/course/{course}','Front\HomeController@courseShow')->name('course.front.show');
Route::post('/booking/course/{id}','Front\HomeController@coursebooking')->name('bookingCourse');

Route::get('/trips','Front\HomeController@trip')->name('trip.front.index');
Route::get('/trip/{trip}','Front\HomeController@tripShow')->name('trip.front.show');
Route::post('/booking/trip/{id}','Front\HomeController@tripbooking')->name('bookingTrip');

Route::get('/offerCourse','Front\HomeController@offerCourse')->name('offer.front.course.index');
Route::get('/offerCourse/{offer}','Front\HomeController@offerCourseShow')->name('offer.front.course.show');

Route::get('/offerTrip','Front\HomeController@offerTrip')->name('offer.front.trip.index');
Route::get('/offerTrip/{offer}','Front\HomeController@offerTripShow')->name('offer.front.trip.show');