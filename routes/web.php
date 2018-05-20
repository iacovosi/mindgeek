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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', [
    'uses' => 'UsersController@index',
    'as' => 'users'
]); 

Route::get('/users/admin/{id}', [
    'uses' => 'UsersController@giveAdminRights',
    'as' => 'user.admin'
]); 

Route::get('/users/undoadmin/{id}', [
    'uses' => 'UsersController@removeAdminRights',
    'as' => 'user.not.admin'
]); 

Route::get('/chatroom/create', [
    'uses' => 'ChatRoomController@create',
    'as' => 'chatroom.create'
]); 

Route::post('/chatroom/store', [
    'uses' => 'ChatRoomController@store',
    'as' => 'chatroom.store'
]); 

Route::get('/chatroom/delete/{id}', [
    'uses' => 'ChatRoomController@destroy',
    'as' => 'chatroom.delete'
]); 

Route::get('/chatroom/join', [
    'uses' => 'ChatRoomController@join',
    'as' => 'chatroom.join'
]); 

Route::get('/chatroom/enter/{room_id}/{user_id}', [
    'uses' => 'ChatRoomController@enter',
    'as' => 'chatroom.enter'
]); 

Route::get('/chatroom/leave/{room_id}/{user_id}', [
    'uses' => 'ChatRoomController@leave',
    'as' => 'chatroom.leave'
]); 

Route::get('/chatroom/show/{room_id}/{user_id}', [
    'uses' => 'MessagesController@show',
    'as' => 'chatroom.show'
]); 

Route::get('/messages/personal/{id}', [
    'uses' => 'MessagesController@showPersonal',
    'as' => 'messages.personal'
]); 

Route::get('/message/create', [
    'uses' => 'MessagesController@create',
    'as' => 'message.create'
]); 

Route::post('/message/store', [
    'uses' => 'MessagesController@store',
    'as' => 'message.store'
]); 
