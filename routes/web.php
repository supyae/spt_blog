<?php

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

//Route::auth();


// cmd hello world write by jh
// change

Route::group(['prefix' => '/supyae'], function () {
   Route::get('/', [
        'as'   => '',
        'uses' => 'WelcomeController@index']);
});

Route::group(['prefix' => '/'], function () {
    Route::get('/', [
        'as'   => '',
        'uses' => 'WelcomeController@index']);

    Route::get('search', [
        'as'   => '/search',
        'uses' => 'WelcomeController@search']);

    Route::get('error', [
        'as'   => '/error',
        'uses' => function () {
            return view('layouts.error');
        }
    ]);
});


Route::group(['namespace' => 'Auth'], function () {
    Route::group(['prefix' => '/'], function () {

        /****** Login **********/
        Route::get('login', [
            'as'   => 'login',
            'uses' => 'LoginController@showLoginForm'
        ]);

        Route::post('login', [
            'as'   => 'login',
            'uses' => 'LoginController@login'
        ]);

        Route::get('logout', [
            'as'   => 'logout',
            'uses' => 'LoginController@logout'
        ]);

        /******* Register ********/
        Route::get('register', [
            'as'   => 'register',
            'uses' => 'RegisterController@showRegistrationForm'
        ]);

        Route::post('register', [
            'as'   => 'register',
            'uses' => 'RegisterController@register'
        ]);
    });
});

Route::group([
    'prefix' => 'blog'], function () {

    Route::post('/', [
        'middleware' => 'auth',
        'as'         => 'blog',
        'uses'       => 'BlogController@create'
    ]);

    Route::put('/', [
        'middleware' => 'auth',
        'as'   => 'blog',
        'uses' => 'BlogController@update'
    ]);

    Route::get('/{id}', [
        'as'         => 'blog/{id}',
        'uses'       => 'BlogController@get'
    ]);
});

Route::group([
    'middleware' => 'auth',
    'prefix'     => 'comment'], function () {

    Route::post('/', [
        'as'   => 'comment',
        'uses' => 'CommentController@create'
    ]);

    Route::post('reply', [
        'as'   => 'comment/reply',
        'uses' => 'CommentController@reply'
    ]);


});