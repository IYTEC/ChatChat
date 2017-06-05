<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function() {
  return view('chat');
})->middleware('auth');

Route::get('/privateMessage', function() {
  return view('privateMessage');
})->middleware('auth');

// Route::get('/users', 'HomeController@users');
// Route::get('/signedinuser', 'HomeController@signedinuser');

Route::get('/users', function() {
  return App\User::all();
})->middleware('auth');

Route::get('/signedinuser', function() {
  return Auth::user();
})->middleware('auth');

Route::post('/getUserConversation', 'ChatController@getUserConversationById');
Route::post('/saveChat', 'ChatController@saveuserchat');

Route::post('/getPrivateMessageNotifications', 'PrivateMessageController@getUserNotifications');
Route::post('/getPrivateMessages', 'PrivateMessageController@getPrivateMessages');
Route::post('/getPrivateMessage', 'PrivateMessageController@getPrivateMessageById');
Route::post('/getPrivateMessagesSent', 'PrivateMessageController@getPrivateMessageSent');
Route::post('/sendPrivateMessage', 'PrivateMessageController@sendPrivateMessage');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
