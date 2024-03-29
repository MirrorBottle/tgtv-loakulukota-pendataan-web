<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('App\Http\Controllers\Api')->group(function () {
  Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::get('maintenance', 'AuthController@maintenance');
  });
  Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
      Route::post('change-password/{id}', 'AuthController@changePassword');
      Route::get('info/{id}', 'AuthController@info');
    });

    Route::group(['prefix' => 'announcement'], function() {
      Route::get('/latest', 'AnnouncementController@latest');
      Route::get('/{id}', 'AnnouncementController@show');
      Route::get('/', 'AnnouncementController@index');
      Route::post('/', 'AnnouncementController@store');
    });

    Route::group(['prefix' => 'villager'], function() {
      Route::post('/birth', 'VillagerController@birth');
      Route::post('/move-in', 'VillagerController@moveIn');
      Route::post('/death', 'VillagerController@death');
      Route::post('/move-out/{id}', 'VillagerController@moveOut');
      Route::get('/family/{id}', 'VillagerController@family');
      Route::get('/{id}', 'VillagerController@show');
      Route::get('/', 'VillagerController@index');
    });

    Route::apiResource('family', 'FamilyController');
    Route::get('family/check/{number}', 'FamilyController@check');

    Route::group(['prefix' => 'neighborhood'], function() {
      Route::get('/list/{id}', 'NeighborhoodController@list');
      Route::get('/info/{id}', 'NeighborhoodController@info');
    });
  });
});
