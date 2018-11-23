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

// 用户注册
Route::post('members','MemberController@insert');

// 用户登录
Route::post('authorization','MemberController@login');

// 使用中间件
Route::middleware(['jwt'])->group(function(){
    Route::post('orders','MemberController@order');
});