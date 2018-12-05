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

Route::get('/', 'HomeController@index');
Route::get('tasks', function () {
    return view('tasks');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add', 'TodoController@store')->name('add');
Route::post('/edit', 'TodoController@update')->name('edit');
Route::post('/completed', 'TodoController@completed');
Route::get('/delete/{id}', 'TodoController@destroy')->name('delete');
