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

Route::namespace('Index')->group(function(){
    Route::get('/', 'Dashboard@index');
    // Route::resource('topic', 'Topics');
});

Route::namespace('SystemAdmin')->group(function(){
    Route::resource('department', 'Department');
    Route::resource('users', 'ManageUser');
    Route::post('/ajaxdp/{id}',[
        'as' => 'users.ajaxdp',
        'uses' => 'ManageUser@ajaxdp'
    ]);
    Route::post('/ajaxps/{id}',[
        'as' => 'users.ajaxps',
        'uses' => 'ManageUser@ajaxps'
    ]);
});
