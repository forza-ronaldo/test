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
            Route::resource('Client', 'client\clientController')->except('index','create','store','show','destroy');
            //pages view bills
            Route::get('new/Telecome/bill/{phone_number}/{course_number}', 'client\billTelecomeController@show')->name('telecome.bills.view');
            Route::get('new/Electricity/bill/{hour_number}/{course_number}', 'client\billElecticityController@show')->name('electricity.bills.view');
            Route::get('new/Water/bill/{counter_number}/{course_number}', 'client\billWaterController@show')->name('water.bills.view');

            Route::get('archived/Telecome/bill/{phone_number}/{course_number}', 'client\billTelecomeController@showArchived')->name('archived.telecome.bills.view');
            Route::get('archived/Electricity/bill/{hour_number}/{course_number}', 'client\billElecticityController@showArchived')->name('archived.electricity.bills.view');
            Route::get('archived/Water/bill/{counter_number}/{course_number}', 'client\billWaterController@showArchived')->name('archived.water.bills.view');

            Route::post('Telecome/bill/pay/{phone_number}/{course_number}/idBank/{id_bank}','client\billTelecomeController@pay')->name('telecome.bill.pay');
            Route::post('Electricity/bill/pay/{hour_number}/{course_number}/idBank/{id_bank}','client\billElecticityController@pay')->name('electricity.bill.pay');
            Route::post('Water/bill/pay/{counter_number}/{course_number}/idBank/{id_bank}','client\billWaterController@pay')->name('water.bill.pay');

            Route::post('Telecome/bill/pay/all','client\billTelecomeController@payAll')->name('telecome.bill.payAll');
            Route::post('Electricity/bill/pay/all','client\billElecticityController@payAll')->name('electricity.bill.payAll');
            Route::post('Water/bill/pay/all','client\billWaterController@payAll')->name('water.bill.payAll');
        });

        Route::prefix('myBills/new')->group(function () {
            Route::get('/telecome', 'client\homeController@telecome')->name('new.telecome');
            Route::get('/electricity', 'client\homeController@electricity')->name('new.electricity');
            Route::get('/water', 'client\homeController@water')->name('new.water');
        });

        Route::prefix('myBills/archived')->group(function () {
            Route::get('/telecome', 'client\billTelecomeController@archived')->name('archived.telecome');
            Route::get('/electricity', 'client\billElecticityController@archived')->name('archived.electricity');
            Route::get('/water', 'client\billWaterController@archived')->name('archived.water');
        });

        Route::resource('myBills/places','client\placeController')->except('edit','update','store','destroy','create');

        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::get('/logout', function () {
            Auth::logout();
            return redirect()->route('login');
        });
    }
);
