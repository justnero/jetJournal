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

Route::get('/', 'HomeController@index')->name('home.index');

Route::resource('group', 'GroupController');
Route::get('group/{group}/list', 'GroupController@list')->name('group.list');
Route::get('group/{group}/stat', 'GroupController@stat')->name('group.stat');
Route::patch('group/{group}/list', 'GroupController@list_update')->name('group.list_update');
Route::get('group/{group}/delete', 'GroupController@delete')->name('group.delete');

Route::resource('student', 'StudentController');
Route::get('student/link', 'StudentController@link')->name('student.link');

Route::resource('class', 'ClassController');
Route::get('class/{class}/delete', 'ClassController@delete')->name('class.delete');
Route::patch('class/{class}/attendance', 'ClassController@attendance')->name('class.attendance');