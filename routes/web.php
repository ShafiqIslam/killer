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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/demo', 'HomeController@demo')->name('demo');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login-post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');
Route::post('/dashboard/death', 'DashboardController@storeDeath')->name('death.store')->middleware('auth');
Route::post('/dashboard/death/{death}', 'DashboardController@updateDeath')->name('death.update')->middleware('auth');