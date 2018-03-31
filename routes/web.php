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

/**
 * Companies resource route with basic authentication
 */
Route::resource('companies', 'CompanyController')->middleware('auth.basic');

/**
 * Employees resource route with basic authentication
 */
Route::resource('employees', 'EmployeeController')->middleware('auth.basic');

/**
 * About route with basic authentication
 */
Route::get('/about', function () {
    return view('about');
})->middleware('auth.basic');

/**
 * Localization route with basic authentication
 */
Route::get('/localization', 'LocalizationController@index');

/**
 * Localization route with basic authentication
 */
Route::post('/localization/{locale}', 'LocalizationController@changeLocale');