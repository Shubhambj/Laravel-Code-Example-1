<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Auth::routes([
    // To disable routes from default Laravel Auth
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/employee', 'EmployeeController@index')->name('employee.index');
    Route::get('/employee/create', 'EmployeeController@create')->name('employee.create');
    Route::post('/employee', 'EmployeeController@store')->name('employee.store');
    Route::get('/employee/{id}', 'EmployeeController@show')->name('employee.show');
    Route::get('/employee/{id}/edit', 'EmployeeController@edit')->name('employee.edit');
    Route::put('/employee/{id}', 'EmployeeController@update')->name('employee.update');
    Route::delete('/employee/{id}', 'EmployeeController@destroy')->name('employee.destroy');
    
    
    Route::get('/company', 'CompanyController@index')->name('company.index');
    Route::get('/company/create', 'CompanyController@create')->name('company.create');
    Route::post('/company', 'CompanyController@store')->name('company.store');
    Route::get('/company/{id}', 'CompanyController@show')->name('company.show');
    Route::get('/company/{id}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('/company/{id}', 'CompanyController@update')->name('company.update');
    Route::delete('/company/{id}', 'CompanyController@destroy')->name('company.destroy');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('lang/change', 'LangController@changeLanguage')->name('change_language');
