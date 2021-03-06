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

// Grabbing users.
Route::get('/users', 'UserController@getAllUsers');
Route::get('/user/{email}', 'UserController@getUser');
Route::get('/user/username/{username}', 'UserController@getUserByUsername');

// Create user.
Route::post('/users/create',['uses' => 'RegistrationController@store']);

// Verify if user has confirmed email.
Route::get('/verify/{id}/{token}', ['uses' => 'VerifyEmailController@verify']);

// Forgotten password
Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
Route::post('/forgot-password-check', 'ForgotPasswordController@checkUser');

// UserInfo
Route::post('/userInfo', 'UserInfoController@postInfo');
Route::post('/tempStoreImg', 'UserInfoController@tempStore');
Route::put('/userInfo/edit', 'UserInfoController@editInfo');

// Photography types

// Follows
Route::post('user/{loggedUserId}/follows/{userId}', 'FollowsController@add');
Route::delete('user/{loggedUserId}/follows/{userId}/delete', 'FollowsController@delete');
Route::get('user/{loggedUserId}/follows', 'FollowsController@getFollows');

// Followers
Route::get('user/{loggedUserId}/followers', 'FollowsController@getFollowers');

// Posts
Route::post('/post', 'PostController@postPost');
Route::get('/posts', 'PostController@getPosts');
Route::get('/posts/{username}', 'PostController@getPostUser');

// Comments
Route::post('/post/{postId}/postComment', 'CommentsController@postComment');
Route::get('/post/{postId}/getComments', 'CommentsController@getComments');
Route::post('/post/{postId}/deleteComment/{commentId}', 'CommentsController@deleteComment');

// Likes
Route::post('post/{postId}/like', 'LikesController@likePost');

//
Route::post('/quote', ['uses' => 'QuoteController@postQuote']);
Route::get('/quotes', ['uses' => 'QuoteController@getQuotes']);
Route::put('/quote/{id}', ['uses' => 'QuoteController@putQuote']);
Route::delete('/quote/{id}', ['uses' => 'QuoteController@deleteQuote']);