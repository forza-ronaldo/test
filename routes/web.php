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

use Illuminate\Support\Facades\Auth;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Auth::routes();

        Route::get('/myBills', 'client\homeController@index')->name('home');

        Route::prefix('myBills')->group(function () {

            Route::resource('Question', 'client\questionController');

            //pages view bills
            Route::get('Telecome/bill/{phone_number}/{course_number}', 'client\billTelecomeController@show')->name('telecome.bills.view');
            Route::get('Electricity/bill/{hour_number}/{course_number}', 'client\billElecticityController@show')->name('electricity.bills.view');
            Route::get('Water/bill/{counter_number}/{course_number}', 'client\billWaterController@show')->name('water.bills.view');

            Route::post('Telecome/bill/pay/{phone_number}/{course_number}/idBank/{id_bank}','client\billTelecomeController@pay')->name('telecome.bill.pay');
            Route::post('Electricity/bill/pay/{hour_number}/{course_number}/idBank/{id_bank}','client\billElecticityController@pay')->name('electricity.bill.pay');
            Route::post('Water/bill/pay/{counter_number}/{course_number}/idBank/{id_bank}','client\billWaterController@pay')->name('water.bill.pay');
        });

        Route::prefix('myBills/new')->group(function () {
            Route::get('/telecome', 'client\homeController@telecome')->name('new.telecome');
            Route::get('/electricity', 'client\homeController@electricity')->name('new.electricity');
            Route::get('/water', 'client\homeController@water')->name('new.water');
        });

        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::get('/logout', function () {
            Auth::logout();
            return redirect()->route('login');
        });
    }
);
