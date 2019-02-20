<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('index','api\UserController@index');
Route::get('story','api\UserController@story');
Route::get('community','api\UserController@community');
Route::get('peoplegallery','api\UserController@peoplegallery');
Route::get('peoplegallery_album/{id}','api\UserController@peoplegallery_album');
Route::get('news_event','api\UserController@news_event');
Route::get('news_event_content/{id}','api\UserController@news_event_content');
Route::get('directory','api\UserController@directory');
Route::get('careers','api\UserController@careers');
Route::get('getjobdescription/{id}','api\UserController@getjobdescription');
Route::post('search_job/{id}','api\UserController@search_job');
Route::post('insert_contact','api\UserController@insert_contact');
Route::post('insertuserapplication','api\UserController@insertuserapplication');

Route::get('customer','AdminController@customer');