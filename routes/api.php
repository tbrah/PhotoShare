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

Route::get('/users', function (Request $request){
	return response()->json(\App\User::all());
})->middleware('auth:api');

Route::post('/users/create',['uses' => 'RegistrationController@store']);

Route::get('/verify/{id}/{token}', ['uses' => 'VerifyEmailController@verify']);

Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
Route::post('/forgot-password-check', 'ForgotPasswordController@checkUser');

Route::post('/quote', ['uses' => 'QuoteController@postQuote']);
Route::get('/quotes', ['uses' => 'QuoteController@getQuotes']);

/*
Route::get('/quotes', function (Request $request) {
    return response()->json(\App\Quote::all());
})->middleware('auth:api');
*/

Route::put('/quote/{id}', ['uses' => 'QuoteController@putQuote']);

Route::delete('/quote/{id}', ['uses' => 'QuoteController@deleteQuote']);