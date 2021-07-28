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

Auth::routes();
Auth::routes([
    'confirm' => false,
    'forgot' => false,
    'login' => true,
    'register' => false,
    'reset' => false,
    'verification' => false,
]);
//переводы
Route::group(['prefix' => 'operation', 'middleware' => ['auth']], function(){
    Route::match(['get', 'post'], '/transfer', 'FinanceController@transfer')->name('operation.transfer');
    Route::match(['get', 'post'], '/refill', 'FinanceController@refill')->name('operation.refill');
    Route::match(['get', 'post'], '/withdrawal', 'FinanceController@withdrawal')->name('operation.withdrawal');
});
//admin панель
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::match(['get', 'post'], '/', 'AdminController@index')->name('admin.index');
    Route::match(['get', 'post'], '/user{id}', 'AdminController@profile')->name('admin.user');

});
