<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::post('up', 'signUp');
        Route::post('out', 'signOut');
    });
    Route::get('what-is-my-platform', 'whatIsMyPlatform');


});

        Route::post('add-member' ,[MemberController::class , 'store']);
        Route::get('getHome' ,[MemberController::class , 'getHome']);
        Route::get('getAllGovernorates' ,[MemberController::class , 'getAllGovernorates']);
        Route::get('getAllCountry' ,[MemberController::class , 'getAllCountry']);
        Route::get('getAllNews' ,[MemberController::class , 'getAllNews']);
        Route::get('getSettings' ,[MemberController::class , 'getSettings']);
        Route::post('StoreToken' ,[MemberController::class , 'StoreToken']);
        Route::get('getNotifications' ,[MemberController::class , 'getNotifications']);

