<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

#----------------------------------- Admin Section -------------------------------
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin_dashboard');
Route::get('/admin/addcar', 'AdminController@addcar')->name('admin_addcar');
Route::post('/admin/addcar/save', 'AdminController@savecar')->name('admin_savecar');
Route::post('/admin/addcar/edit', 'AdminController@editcar')->name('admin_editcar');
Route::post('/admin/addcar/delete', 'AdminController@deletecar')->name('admin_deletecar');
Route::get('/admin/details', 'AdminController@details')->name('admin_details');
Route::post('/admin/details/offer', 'AdminController@offerfare')->name('admin_offerfare');
Route::post('/admin/details/na', 'AdminController@notavailable')->name('admin_notavailable');

#----------------------------------- Customer Section -------------------------------
Route::get('/customer/dashboard', 'CustomerController@dashboard')->name('customer_dashboard');
Route::post('/customer/bookcar', 'CustomerController@bookcar')->name('customer_bookcar');
Route::get('/customer/bookings', 'CustomerController@bookings')->name('customer_bookings');
Route::post('/customer/bookings/acceptfare', 'CustomerController@acceptfare')->name('customer_acceptfare');
Route::post('/customer/bookings/delete', 'CustomerController@deletebooking')->name('customer_deletebooking');
