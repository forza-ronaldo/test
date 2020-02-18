<?php

use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            Route::get('/admin', 'WelcomeController@admin')->name('admin');

            Route::resource('/user', 'userController');

            //place
            Route::resource('/place', 'placeController');

            //question
            Route::resource('/question', 'questionController');


            Route::get('/questionAwaitingTheAnswer', 'questionController@questionAwaitingTheAnswer')->name('questionAwaitingTheAnswer');
            Route::get('/pendingQuestions', 'questionController@pendingQuestions')->name('pendingQuestions');
            Route::post('/SendReply/{question}', 'questionController@sendReply')->name('questionSendReply');

            //Route::post('/sendAnswer', 'questionController@sendReply')->name('send.answer');

            Route::get('/logout', function () {
                Auth::logout();
                return redirect()->route('login');
            });
        });
    }
);
