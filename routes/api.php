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

Route::get('/members', 'API\MemberController@allMembers');

Route::get('/subs', 'API\MemberController@subs');

Route::get('isys-members', 'API\IsysMemberController@allMembers');
Route::get('isys', 'API\IsysMemberController@test');
Route::get('amount0', 'API\IsysMemberController@amountZero');